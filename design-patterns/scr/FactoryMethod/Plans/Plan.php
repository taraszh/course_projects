<?php

namespace App2\FactoryMethod\Plans;

abstract class Plan
{
    protected array $feature = [];

    abstract public function getRate(): int;

    public function getFeatures(): array
    {
        return $this->feature;
    }
}
