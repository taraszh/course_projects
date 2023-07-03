<?php

namespace App\Filter\Modifier;

use App\DTO\PriceEnquiryInterface;
use App\Entity\Promotion;

class EvenItemsMultiplier implements PriceModifierInterface
{

    public function modify(int $price, int $quantity, Promotion $promotion, PriceEnquiryInterface $enquiry): int
    {
        if ($quantity < 2) {

            return $price * $quantity;
        }

        $oddCount = $quantity % 2;

        $evenCount = $quantity - $oddCount;

        return (($evenCount * $price) * $promotion->getAdjustment()) + ($oddCount * $price);
    }
}
