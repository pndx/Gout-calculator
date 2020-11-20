<?php

namespace Database\Factories;

use Exception;
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
     * @throws Exception
     */
    public function definition(): array
    {
        return [
            'name'       => $this->faker->name,
            'age'        => random_int(10, 60),
            'address'    => $this->faker->address,
            'is_painful' => random_int(0, 1) === 1,
            'purine'     => random_int(100, 1000),
        ];
    }
}
