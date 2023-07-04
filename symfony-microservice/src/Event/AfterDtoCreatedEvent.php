<?php

namespace App\Event;

use App\DTO\PromotionEnquiryInterface;
use Symfony\Contracts\EventDispatcher\Event;

class AfterDtoCreatedEvent extends Event
{
    public const NAME = 'dto.created';

    public function __construct(protected PromotionEnquiryInterface $dot)
    {
    }

    /**
     * @return PromotionEnquiryInterface
     */
    public function getDot(): PromotionEnquiryInterface
    {
        return $this->dot;
    }
}
