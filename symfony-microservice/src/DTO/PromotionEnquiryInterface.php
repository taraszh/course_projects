<?php

namespace App\DTO;

use App\Entity\Product;

interface PromotionEnquiryInterface
{
    public function getProduct(): ?Product;
    public function setPromotionName(string $promotionName): void;
}
