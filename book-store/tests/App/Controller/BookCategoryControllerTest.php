<?php

namespace App\Tests\App\Controller;

use App\Controller\BookCategoryController;
use PHPUnit\Framework\TestCase;
use Symfony\Bundle\FrameworkBundle\Test\WebTestCase;
use Symfony\Component\HttpFoundation\Request;

class BookCategoryControllerTest extends WebTestCase
{

    public function testGet(): void
    {
        $client = self::createClient();
        $client->request(Request::METHOD_GET, '/api/v1/book/category');

        $responseContent = $client->getResponse()->getContent();
        $this->assertResponseIsSuccessful();
        $jsonFile = __DIR__ . '/responses/BookCategoryControllerTest_testGet.json';
        $this->assertJsonStringEqualsJsonFile($jsonFile, $responseContent);

    }
}
