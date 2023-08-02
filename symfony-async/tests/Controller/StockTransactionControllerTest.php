<?php

namespace Controller;

use Symfony\Bundle\FrameworkBundle\Test\WebTestCase;
use function PHPUnit\Framework\assertCount;

class StockTransactionControllerTest extends WebTestCase
{
    public function testBuyStocks(): void
    {
        $client = static::createClient();

        $client->request('GET', '/buy');

        self::assertResponseIsSuccessful();

        $transport = $this->getContainer()->get('messenger.transport.async');
        assertCount(1, $transport->getSent());
    }
}
