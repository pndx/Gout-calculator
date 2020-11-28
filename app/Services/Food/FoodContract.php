<?php

namespace App\Services\Food;

interface FoodContract
{
    public function weight(float $weight): FoodContract;

    public function calculatePurine(): FoodContract;

    public function getPurine(): float;
}
