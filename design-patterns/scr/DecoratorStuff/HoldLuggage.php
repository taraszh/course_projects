<?php

namespace App2\DecoratorStuff;

class HoldLuggage extends FlightReservationDecorator
{
    private const PRICE = 60;

    public function calculatePrice(): int
    {
        return $this->flightReservation->calculatePrice() + self::PRICE;
    }
}
