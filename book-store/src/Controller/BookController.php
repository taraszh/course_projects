<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;

class BookController extends AbstractController
{
    public function __construct()
    {
    }

    #[Route(path: '/api/new-book', name: 'book_post', methods: ['POST'])]
    public function createBook(): Response
    {
        return $this->json([]);
    }
}
