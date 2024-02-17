<?php

namespace App\Tests\App\Service;

use App\Entity\BookCategory;
use App\Model\BookCategoryListItem;
use App\Model\BookCategoryListResponse;
use App\Repository\BookCategoryRepository;
use App\Service\BookCategoryService;
use Doctrine\Common\Collections\Criteria;
use PHPUnit\Framework\TestCase;

class BookCategoryServiceTest extends TestCase
{

    public function testGetCategories(): void
    {
        $bookCategory = new BookCategory();
        $bookCategory->setId(1);
        $bookCategory->setSlug('some_slug');
        $bookCategory->setTitle('Some Title');

        $repo = $this->createMock(BookCategoryRepository::class);
        $repo->expects($this->once())
            ->method('findBy')
            ->with([],['title' => Criteria::ASC])
            ->willReturn([$bookCategory]);

        $expectedListItem = new BookCategoryListItem('1', 'Some Title', 'some_slug');
        $expectedBookCategoryListResponse = new BookCategoryListResponse([$expectedListItem]);

        $service = new BookCategoryService($repo);

        self::assertEquals($expectedBookCategoryListResponse, $service->getCategories());

    }
}
