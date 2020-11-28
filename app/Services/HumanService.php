<?php

namespace App\Services;

use Auth;
use App\Models\Human;
use App\Models\HumanFoodLog;

class HumanService
{
    protected $human;

    public function __construct(Human $human)
    {
        $this->human = $human;
    }

    public function eat(FoodService $foodService): Human
    {
        $this->human->purine += $foodService->getPurine();
        $this->human->save();

        $food = $foodService->getFood();
        if (!empty($food)) {
            foreach ($food as $item) {
                HumanFoodLog::create([
                    'user_id'  => Auth::id(),
                    'human_id' => $this->human->id,
                    'food_id'  => $item[0]->id,
                    'weight'   => $item[1],
                    'purine'   => $item[2],
                ]);
            }
        }

        return $this->human;
    }
}
