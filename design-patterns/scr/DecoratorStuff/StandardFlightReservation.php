<?php

namespace App2\DecoratorStuff;

class StandardFlightReservation implements FlightReservation
{

    public function calculatePrice(): int
    {

        return 300;
    }
}
