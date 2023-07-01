<?php

namespace App\Filter;

use App\DTO\PromotionEnquiryIterface;
use App\Entity\Promotion;

class LowestPriceFilter implements PromotionFilterInterface
{

    public function apply(
        PromotionEnquiryIterface $enquiry,
        Promotion ...$promotion,

    ): PromotionEnquiryIterface {
        $enquiry->setDiscountedPrice(50);
        $enquiry->setPrice(100);
        $enquiry->setPromotionId(3);
        $enquiry->setPromotionName('Black Friday half price sale');

        return $enquiry;
    }
}
