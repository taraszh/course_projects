<?php

namespace App\Filter;

use App\DTO\PromotionEnquiryIterface;
use App\Entity\Promotion;
use App\Filter\Factory\PriceModifierFactoryInterface;

class LowestPriceFilter implements PromotionFilterInterface
{

    public function __construct(private PriceModifierFactoryInterface $priceModifierFactory)
    {
    }

    public function apply(
        PromotionEnquiryIterface $enquiry,
        Promotion ...$promotions,

    ): PromotionEnquiryIterface {
        $price = $enquiry->getProduct()->getPrice();
        $quantity = $enquiry->getQuantity();
        $lowestPrice = $quantity * $price;


        foreach ($promotions as $promotion) {
            $priceModifier = $this->priceModifierFactory->create($promotion->getType());

            dd($priceModifier);

            $enquiry->setDiscountedPrice(50);
            $enquiry->setPrice(100);
            $enquiry->setPromotionId(3);
            $enquiry->setPromotionName('Black Friday half price sale');

        }


        return $enquiry;
    }
}
