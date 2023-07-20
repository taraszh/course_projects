<?php

namespace App2\FactoryMethod\Plans\Pro;

use App2\FactoryMethod\Plans\Plan as MasterPlan;

class Plan extends MasterPlan
{
    private const RATE = 150;
    protected  array $features = ['top newbie grade armor', 'top newbie grade sword'];

    public function getRate(): int
    {
        return self::RATE;
    }
}
