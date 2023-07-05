<?php

namespace App\Controller;

use App\Cache\PromotionsCache;
use App\DTO\LowestPriceEnquiry;
use App\Filter\PromotionFilterInterface;
use App\Repository\ProductRepository;
use App\Service\Serializer\DTOSerializer;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

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
        $lowestPriceEnquiry = $serializer->deserialize(
            $request->getContent(),
            LowestPriceEnquiry::class,
            'json'
        );

        $product = $this->productRepository->findOrFail($id);

        $lowestPriceEnquiry->setProduct($product);

        $requestDate = date_create_immutable($lowestPriceEnquiry->getRequestDate());
        $promotions  = $cache->findValidForProduct($product, $requestDate);

        $modifiedEnquiry = $promotionFilter->apply($lowestPriceEnquiry, ...$promotions);

        $responseContent = $serializer->serialize($modifiedEnquiry, 'json');

        return new JsonResponse(data: $responseContent, status: Response::HTTP_OK, json: true);
    }
}
