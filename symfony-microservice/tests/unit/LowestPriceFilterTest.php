<?php

namespace App\Tests\unit;

use App\DTO\LowestPriceEnquiry;
use App\Entity\Product;
use App\Entity\Promotion;
use App\Filter\LowestPriceFilter;
use App\Tests\ServiceTestCase;

class LowestPriceFilterTest extends ServiceTestCase
{
    public function testLowerPricePromotions_filtering_is_applied_correctly(): void
    {
        $product = new Product();
        $product->setPrice(100);

        $enquiry = new LowestPriceEnquiry();
        $enquiry->setProduct($product);
        $enquiry->setQuantity(5);
        $enquiry->setRequestDate('2023-11-27');
        $enquiry->setVoucherCode('OU812');

        $promotions = $this->promotionsDataProvider();

        $filter = $this->container->get(LowestPriceFilter::class);

        $filteredEnquiry = $filter->apply($enquiry, ...$promotions);

        self::assertSame(100, $filteredEnquiry->getPrice());
        self::assertSame(250, $filteredEnquiry->getDiscountedPrice());
        self::assertSame('Black Friday half price sale', $filteredEnquiry->getPromotionName());
    }

    private function promotionsDataProvider(): array
    {
        $promotionOne = new Promotion();
        $promotionOne->setName('Black Friday half price sale');
        $promotionOne->setAdjustment(0.5);
        $promotionOne->setCriteria(["from" => "2023-11-25", "to" => "2023-11-28"]);
        $promotionOne->setType('date_range_multiplier');

        $promotionTwo = new Promotion();
        $promotionTwo->setName('Voucher OU812');
        $promotionTwo->setAdjustment(100);
        $promotionTwo->setCriteria(["code" => "OU812"]);
        $promotionTwo->setType('fixed_price_voucher');

        $promotionThree = new Promotion();
        $promotionThree->setName('Buy one get one free');
        $promotionThree->setAdjustment(0.5);
        $promotionThree->setCriteria(["minimum_quantity" => 2]);
        $promotionThree->setType('even_items_multiplier');

        return [$promotionOne, $promotionTwo, $promotionThree];
    }

}
