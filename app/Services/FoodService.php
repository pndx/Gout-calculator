<?php

namespace App\Services;

use App\Models\Food;

class FoodService
{
    protected $food = [];
    protected $weight = 0.00;
    protected $purine = 0.00;

    public function addFood(Food $food, float $foodWeight): FoodService
    {
        $foodPurine = self::calculatePurine($food, $foodWeight);
        $this->food[] = [$food, $foodWeight, $foodPurine];
        $this->weight += $foodWeight;
        $this->purine += $foodPurine;
        return $this;
    }

    public function getWeight(): float
    {
        return $this->weight;
    }

    public function getPurine(): float
    {
        return $this->purine;
    }

    public function getFood(): array
    {
        return $this->food;
    }

    protected static function calculatePurine(Food $food, float $foodWeight): float
    {
        return round($foodWeight / 100 * $food->purine, 2);
    }
}
