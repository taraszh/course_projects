<?php

namespace App2\DecoratorStuff;

abstract class FlightReservationDecorator implements FlightReservation
{
    public function __construct(protected FlightReservation $flightReservation)
    {
    }
}
