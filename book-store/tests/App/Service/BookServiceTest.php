<?php

namespace App\Tests\App\Service;

use App\Exception\BookCategoryNotFoundException;
use App\Repository\BookCategoryRepository;
use App\Repository\BookRepository;
use App\Service\BookService;
use PHPUnit\Framework\TestCase;

class BookServiceTest extends TestCase
{

    public function testGetBookByCategoryNotFoundException()
    {
        $repositoryBook = $this->createMock(BookRepository::class);
        $repositoryBookCategory = $this->createMock(BookCategoryRepository::class);
        $repositoryBookCategory->expects($this->once())
            ->method('find')
            ->with(123)
            ->willThrowException(new BookCategoryNotFoundException());

        $this->expectException(BookCategoryNotFoundException::class);
        (new BookService($repositoryBookCategory, $repositoryBook))->getBookByCategory(123);
    }
}
