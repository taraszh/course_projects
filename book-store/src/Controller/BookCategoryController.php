<?php

namespace App\Controller;

use App\Model\BookCategoryListResponse;
use App\Service\BookCategoryService;
use Nelmio\ApiDocBundle\Annotation\Model;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;
use OpenApi\Attributes as OA;

class BookCategoryController extends AbstractController
{
    public function __construct(private BookCategoryService $bookCategoryService)
    {
    }

    #[Route(path: '/api/v1/book/category', name: 'category_get', methods: ['GET'])]
    #[OA\Response(
        response: 200,
        description: 'Returns book categories',
        attachables: [new Model(type: BookCategoryListResponse::class)]
    )]
    public function get(): Response
    {
        return $this->json($this->bookCategoryService->getCategories());
    }
}
