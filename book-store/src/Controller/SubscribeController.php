<?php

namespace App\Controller;

use App\Attribute\RequestBody;
use App\Model\BookCategoryListResponse;
use App\Model\SubscriberRequest;
use App\Service\BookCategoryService;
use App\Service\SubscriberService;
use Nelmio\ApiDocBundle\Annotation\Model;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;
use OpenApi\Attributes as OA;

class SubscribeController extends AbstractController
{
    public function __construct(private SubscriberService $subscriberService)
    {
    }

    #[Route(path: '/api/v1/subscribe', name: 'category_get', methods: ['POST'])]
    #[OA\Response(
        response: 200,
        description: 'Subscribe email to newsletter mailing list'
    )]
    public function create(#[RequestBody] SubscriberRequest $subscriberRequest): Response
    {
        $this->subscriberService->subscribe($subscriberRequest);

        return $this->json(null);
    }
}
