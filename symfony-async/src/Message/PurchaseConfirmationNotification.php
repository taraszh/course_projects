<?php

namespace App\Message;

class PurchaseConfirmationNotification
{
    public function __construct(private object $order)
    {

    }

    /**
     * @return object
     */
    public function getOrder(): object
    {
        return $this->order;
    }

}
