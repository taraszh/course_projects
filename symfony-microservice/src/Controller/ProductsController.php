<?php

namespace App\Controller;

use App\Cache\PromotionsCache;
use App\DTO\LowestPriceEnquiry;
use App\Entity\Promotion;
use App\Filter\PromotionFilterInterface;
use App\Repository\ProductRepository;
use App\Service\Serializer\DTOSerializer;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\Serializer\SerializerInterface;
use Symfony\Contracts\Cache\CacheInterface;
use Symfony\Contracts\Cache\ItemInterface;

class ProductsController extends AbstractController
{
    public function __construct(
        private ProductRepository $productRepository,
        private EntityManagerInterface $manager,
    ) {
    }

    #[Route('/products/{id}/lowest-price', name: 'lowest-price', methods: 'POST')]
    public function lowestPrice(
        Request $request,
        int $id,
        DTOSerializer $serializer,
        PromotionFilterInterface $promotionFilter,
        PromotionsCache $cache
    ): Response {
        if ($request->headers->has('force_fail')) {

            return new JsonResponse(
                ['error' => 'Promotions Engine failure message'],
                $request->headers->get('force_fail')
            );
        }

        $lowestPriceEnquiry = $serializer->deserialize(
            $request->getContent(),
            LowestPriceEnquiry::class,
            'json'
        );

        $product = $this->productRepository->find($id); // add error handling

        $lowestPriceEnquiry->setProduct($product);

        $requestDate = date_create_immutable($lowestPriceEnquiry->getRequestDate());
        $promotions  = $cache->findValidForProduct($product, $requestDate);

        $modifiedEnquiry = $promotionFilter->apply(
            $lowestPriceEnquiry,
            ...$promotions
        );

        $responseContent = $serializer->serialize($modifiedEnquiry, 'json');

        return new Response(
            $responseContent,
            Response::HTTP_OK,
            ['Content-type' => 'application/json']
        );

    }








    #[Route('/products/{id}/promotions', name: 'promotions', methods: 'GET')]
    public function promotions()
    {

    }
}
