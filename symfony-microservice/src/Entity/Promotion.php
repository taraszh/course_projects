<?php

namespace App\Entity;

use App\Repository\PromotionRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: PromotionRepository::class)]
class Promotion
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column(length: 255)]
    private ?string $name = null;

    #[ORM\Column(length: 255)]
    private ?string $type = null;

    #[ORM\Column]
    private ?float $adjustment = null;

    #[ORM\Column]
    private array $criteria = [];

    #[ORM\OneToMany(mappedBy: 'promotion', targetEntity: PromotionPromotion::class)]
    private Collection $promotionPromotions;







    public function __construct()
    {
        $this->promotionPromotions = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getName(): ?string
    {
        return $this->name;
    }

    public function setName(string $name): static
    {
        $this->name = $name;

        return $this;
    }

    public function getType(): ?string
    {
        return $this->type;
    }

    public function setType(string $type): static
    {
        $this->type = $type;

        return $this;
    }

    public function getAdjustment(): ?float
    {
        return $this->adjustment;
    }

    public function setAdjustment(float $adjustment): static
    {
        $this->adjustment = $adjustment;

        return $this;
    }

    public function getCriteria(): array
    {
        return $this->criteria;
    }

    public function setCriteria(array $criteria): static
    {
        $this->criteria = $criteria;

        return $this;
    }

    /**
     * @return Collection<int, PromotionPromotion>
     */
    public function getPromotionPromotions(): Collection
    {
        return $this->promotionPromotions;
    }

    public function addPromotionPromotion(PromotionPromotion $promotionPromotion): static
    {
        if (!$this->promotionPromotions->contains($promotionPromotion)) {
            $this->promotionPromotions->add($promotionPromotion);
            $promotionPromotion->setProduct($this);
        }

        return $this;
    }

    public function removePromotionPromotion(PromotionPromotion $promotionPromotion): static
    {
        if ($this->promotionPromotions->removeElement($promotionPromotion)) {
            // set the owning side to null (unless already changed)
            if ($promotionPromotion->getProduct() === $this) {
                $promotionPromotion->setProduct(null);
            }
        }

        return $this;
    }
}
