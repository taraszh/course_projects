<?php

namespace App2\Test;

use App2\DecoratorStuff\ExtraLegroom;
use App2\DecoratorStuff\HoldLuggage;
use App2\DecoratorStuff\StandardFlightReservation;
use PHPUnit\Framework\TestCase;

class FlightReservationTest extends TestCase
{
    public function testFlightReservationCanBeDecorated()
    {
        $reservation = new StandardFlightReservation();
        $reservation = new ExtraLegroom($reservation);
        $reservation = new HoldLuggage($reservation);

        $totalCost = $reservation->calculatePrice();

        self::assertEquals(400, $totalCost);
    }

}
