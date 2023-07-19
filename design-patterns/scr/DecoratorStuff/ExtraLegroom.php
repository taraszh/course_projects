<?php

namespace App2\DecoratorStuff;

class ExtraLegroom extends FlightReservationDecorator
{
    private const PRICE = 40;

    public function calculatePrice(): int
    {
        return $this->flightReservation->calculatePrice() + self::PRICE;
    }
}
