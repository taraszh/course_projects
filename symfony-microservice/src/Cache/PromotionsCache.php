<?php

namespace App\Cache;

use App\Entity\Product;
use App\Repository\PromotionRepository;
use Symfony\Contracts\Cache\CacheInterface;
use Symfony\Contracts\Cache\ItemInterface;

class PromotionsCache
{
    public function __construct(private CacheInterface $cache, private PromotionRepository $promotionRepository)
    {
    }

    public function findValidForProduct(Product $product, \DateTimeInterface $requestDate)
    {
        $key = sprintf('valid-for-product-%d', $product->getId());

        return $this->cache->get(
            $key,
            function(ItemInterface $item) use ($product, $requestDate) {

                $item->expiresAfter(5);

//                var_dump('miss');

                return $this->promotionRepository->findValidForProduct($product, $requestDate);
            }
        );
    }
}
