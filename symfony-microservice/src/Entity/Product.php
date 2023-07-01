<?php

namespace App\Entity;

use App\Repository\ProductRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: ProductRepository::class)]
class Product
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column(type: 'integer')]
    private $id;

    #[ORM\Column]
    private ?int $price = null;

//    #[ORM\OneToMany(mappedBy: 'product', targetEntity: PromotionPromotion::class)]
//    private Collection $promotionPromotions;
//
//    public function __construct()
//    {
//        $this->promotionPromotions = new ArrayCollection();
//    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getPrice(): ?int
    {
        return $this->price;
    }

    public function setPrice(int $price): static
    {
        $this->price = $price;

        return $this;
    }

//    /**
//     * @return Collection<int, PromotionPromotion>
//     */
//    public function getPromotionPromotions(): Collection
//    {
//        return $this->promotionPromotions;
//    }
//
//    public function addPromotionPromotion(PromotionPromotion $promotionPromotion): static
//    {
//        if (!$this->promotionPromotions->contains($promotionPromotion)) {
//            $this->promotionPromotions->add($promotionPromotion);
//            $promotionPromotion->setProduct($this);
//        }
//
//        return $this;
//    }
//
//    public function removePromotionPromotion(PromotionPromotion $promotionPromotion): static
//    {
//        if ($this->promotionPromotions->removeElement($promotionPromotion)) {
//            // set the owning side to null (unless already changed)
//            if ($promotionPromotion->getProduct() === $this) {
//                $promotionPromotion->setProduct(null);
//            }
//        }
//
//        return $this;
//    }
}
