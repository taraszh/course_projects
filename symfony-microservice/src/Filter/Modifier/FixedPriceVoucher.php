<?php

namespace App\Filter\Modifier;

use App\Entity\Promotion;
use App\DTO\PriceEnquiryInterface;

class FixedPriceVoucher implements PriceModifierInterface
{
    public function modify(int $price, int $quantity, Promotion $promotion, PriceEnquiryInterface $enquiry): int
    {
        if (!($enquiry->getVoucherCode() === $promotion->getCriteria()['code'])) {

            return $price * $quantity;
        }

        return $promotion->getAdjustment() * $quantity;
    }
}
