<?php

namespace Database\Factories;

use App\Models\Human;
use Illuminate\Database\Eloquent\Factories\Factory;

class HumanFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = Human::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            'name'       => $this->faker->name,
            'age'        => rand(10, 60),
            'address'    => $this->faker->address,
            'is_painful' => rand(0, 1) === 1,
            'purine'     => rand(100, 1000),
        ];
    }
}
