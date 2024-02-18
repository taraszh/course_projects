<?php

namespace App\Service;

use App\Entity\Book;
use App\Entity\BookCategory;
use App\Exception\BookCategoryNotFoundException;
use App\Model\BookCategoryListItem;
use App\Model\BookCategoryListResponse;
use App\Model\BookListItem;
use App\Model\BookListResponse;
use App\Repository\BookCategoryRepository;
use App\Repository\BookRepository;
use Doctrine\Common\Collections\Criteria;

class BookService
{
    public function __construct(
        private readonly BookCategoryRepository $bookCategoryRepository,
        private readonly BookRepository         $bookRepository,
    ) {
    }

    public function getBookByCategory(int $categoryId): BookListResponse
    {
        $category = $this->bookCategoryRepository->find($categoryId);
        if (!$category) {
            throw new BookCategoryNotFoundException();
        }

        $books = $this->bookRepository->findBookByCategory($categoryId);

        return new BookListResponse(
            array_map(
                $this->map(...),
                $books
            )
        );
    }

    private function map(Book $book): BookListItem
    {
        $item = new BookListItem();
        $item->setId($book->getId());
        $item->setTitle($book->getTitle());
        $item->setSlug($book->getSlug());
        $item->setImage($book->getImage());
        $item->setMeap($book->isMeap());
        $item->setPublicationDate($book->getPublicationDate()->getTimestamp());

        return $item;
    }
}
