<?php

namespace App\Filter\Modifier;

use App\DTO\PromotionEnquiryIterface;
use App\Entity\Promotion;

class DateRangeMultiplier implements PriceModifierInterface
{

    public function modify(int $price, int $quantity, Promotion $promotion, PromotionEnquiryIterface $enquiry): int
    {
        $requestDate = date_create($enquiry->getRequestDate());
        $from = date_create($promotion->getCriteria()['from']);
        $to = date_create($promotion->getCriteria()['to']);

        if (!($requestDate >= $from && $requestDate < $to)) {
            return $price * $quantity;
        }

        return ($price * $quantity) * $promotion->getAdjustment();
    }
}
