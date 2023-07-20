<?php

namespace App2\FactoryMethod\Plans\Free;

use App2\FactoryMethod\Plans\Plan as MasterPlan;

class Plan extends MasterPlan
{
    private const RATE = 0;
    protected  array $features = ['newbie armor', 'newbie sword'];

    public function getRate(): int
    {
        return self::RATE;
    }
}
