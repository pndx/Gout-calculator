<?php

namespace Tests\Feature\Http\Controllers\Api\V1\Food;

use Tests\TestCase;
use App\Models\Food;
use App\Models\User;
use Laravel\Passport\Passport;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Foundation\Testing\RefreshDatabase;

class FoodControllerTest extends TestCase
{
    use RefreshDatabase, WithFaker;

    protected function setUp(): void
    {
        parent::setUp();
        $user = User::factory()->create([
            'email'    => $this->faker->unique()->safeEmail,
            'password' => bcrypt('password'),
        ]);
        Passport::actingAs($user);
    }

    /** @test */
    public function can_get_food_list(): void
    {
        // Arrange
        Food::factory()->count(5)->create();

        // Act
        $response = $this->get(route('api.food.index'));

        // Assert
        $response->assertSuccessful()->assertJsonCount(5, 'data');
    }

    /** @test */
    public function can_add_a_kind_of_new_food(): void
    {
        // Arrange
        $attribute = [
            'name'   => $this->faker->name,
            'purine' => $this->faker->randomNumber(3),
        ];

        // Act
        $this->post(route('api.food.store'), $attribute);

        // Assert
        $this->assertDatabaseHas('food', $attribute);
    }

    /** @test */
    public function can_get_food_information(): void
    {
        // Arrange
        $food = Food::factory()->create();

        // Act
        $response = $this->get(route('api.food.show', $food->id));

        // Assert
        $response->assertSuccessful()->assertJsonStructure([
            'data' => [
                'id',
                'name',
                'purine',
            ],
        ]);
    }

    /** @test */
    public function cannot_get_food_information_with_wrong_id(): void
    {
        // Act
        $response = $this->get(route('api.food.show', 1));

        // Assert
        $response->assertStatus(404);
    }

    /** @test */
    public function can_update_food_information(): void
    {
        // Arrange
        $food = Food::factory()->create();
        $food->purine = $this->faker->randomNumber(2);

        // Act
        $this->put(route('api.food.update', $food->id), $food->toArray());

        $this->assertDatabaseHas('food', ['id' => $food->id, 'purine' => $food->purine]);
    }

    /** @test */
    public function cannot_update_food_information_when_not_exists(): void
    {
        // Arrange
        $food = Food::factory()->make();

        // Act
        $response = $this->put(route('api.food.update', 1), $food->toArray());

        // Assert
        $response->assertStatus(404);
    }

    /** @test */
    public function can_delete_food_by_id(): void
    {
        // Arrange
        $food = Food::factory()->create();

        // Act
        $this->delete(route('api.food.destroy', $food->id));

        // Assert
        $this->assertDatabaseMissing('food', ['id' => $food->id]);
    }

    /** @test */
    public function cannot_delete_food_by_wrong_id(): void
    {
        // Act
        $response = $this->delete(route('api.food.destroy', 1));

        // Assert
        $response->assertStatus(404);
    }
}
