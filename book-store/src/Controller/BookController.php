<?php

namespace App\Controller;

use App\Model\BookCategoryListResponse;
use App\Model\BookListResponse;
use App\Service\BookService;
use Nelmio\ApiDocBundle\Annotation\Model;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;
use OpenApi\Attributes as OA;

class BookController extends AbstractController
{
    public function __construct(private readonly BookService $bookService)
    {
    }

    #[Route(path: '/api/v1/category/{id}/books', name: 'book_by_category_get', methods: ['GET'])]
    #[OA\Response(
        response: 200,
        description: 'Return books by category',
        attachables: [new Model(type: BookListResponse::class)]
    )]
    public function getByCategory(int $id): Response
    {
        return $this->json($this->bookService->getBookByCategory($id));
    }

    #[Route(path: '/api/new-book', name: 'book_post', methods: ['POST'])]
    public function createBook(): Response
    {
        return $this->json([]);
    }
}
