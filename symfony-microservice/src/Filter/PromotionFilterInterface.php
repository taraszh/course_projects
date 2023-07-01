<?php

namespace App\Filter;


use App\DTO\PromotionEnquiryIterface;
use App\Entity\Promotion;

interface PromotionFilterInterface
{
    public function apply(
        PromotionEnquiryIterface $enquiryIterface,
        Promotion ...$promotion
    ): PromotionEnquiryIterface;
}
