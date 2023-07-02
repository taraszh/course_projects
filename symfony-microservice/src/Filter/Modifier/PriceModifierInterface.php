<?php

namespace App\Filter\Modifier;

use App\DTO\PromotionEnquiryIterface;
use App\Entity\Promotion;

interface PriceModifierInterface
{
    public function modify(int $price, int $quantity, Promotion $promotion, PromotionEnquiryIterface $enquiry): int;
}
