<?php

namespace App\Filter;

use App\DTO\PriceEnquiryInterface;
use App\Entity\Promotion;

interface PriceFilterInterface extends PromotionFilterInterface
{
    public function apply(
        PriceEnquiryInterface $enquiryIterface,
        Promotion ...$promotion
    ): PriceEnquiryInterface;
}
