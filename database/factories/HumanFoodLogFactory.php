<?php

namespace Database\Factories;

use App\Models\User;
use App\Models\Food;
use App\Models\Human;
use App\Models\HumanFoodLog;
use Illuminate\Database\Eloquent\Factories\Factory;

class HumanFoodLogFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = HumanFoodLog::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition(): array
    {
        return [
            'user_id'  => $this->faker->unique(true)->numberBetween(1, User::count()),
            'human_id' => $this->faker->unique(true)->numberBetween(1, Human::count()),
            'food_id'  => $this->faker->unique(true)->numberBetween(1, Food::count()),
            'weight'   => $this->faker->randomNumber(3),
            'purine'   => $this->faker->randomNumber(3),
        ];
    }
}
