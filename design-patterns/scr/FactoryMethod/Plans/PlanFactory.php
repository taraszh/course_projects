<?php

namespace App2\FactoryMethod\Plans;

class PlanFactory
{
    public function createPlan(string $plan = 'free'): Plan
    {
        $planName = "App2\\FactoryMethod\\Plans\\" . ucwords($plan) . '\\Plan';

        if (!class_exists($planName)) {
            throw new \Exception('A class with the name ' . $planName . ' could not be found');
        }

        return new $planName();
    }
}
