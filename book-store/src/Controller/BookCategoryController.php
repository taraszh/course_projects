<?php

namespace App\Controller;

use App\Service\BookCategoryService;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;

class BookCategoryController extends AbstractController
{
    public function __construct(private BookCategoryService $bookCategoryService)
    {
    }

    #[Route(path: '/api/v1/book/category', name: 'category_get', methods: ['GET'])]
    public function get(): Response
    {
        return $this->json($this->bookCategoryService->getCategories());
    }
}
