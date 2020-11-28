<?php

namespace App\Services\Food;

class Food implements FoodContract
{
    protected $weight;

    public function weight(float $weight): FoodContract
    {
        $this->weight = $weight;
        return $this;
    }

    public function calculatePurine(): FoodContract
    {
        // TODO: Implement calculatePurine() method.
    }

    public function getPurine(): float
    {
        // TODO: Implement getPurine() method.
    }
}
