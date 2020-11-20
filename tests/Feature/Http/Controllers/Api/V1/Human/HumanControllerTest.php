<?php

namespace Tests\Feature\Http\Controllers\Api\V1\Human;

use Exception;
use Tests\TestCase;
use App\Models\User;
use Laravel\Passport\Passport;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Foundation\Testing\RefreshDatabase;

class HumanControllerTest extends TestCase
{
    use RefreshDatabase, WithFaker;

    /**
     * @test
     * @throws Exception
     */
    public function a_human_can_be_added(): void
    {
        // Arrange
        $user = User::factory()->create([
            'email'    => $this->faker->unique()->safeEmail,
            'password' => bcrypt('password'),
        ]);
        Passport::actingAs($user);

//        $token = $user->createToken('token')->accessToken;

        $attribute = [
            'name'       => $this->faker->name,
            'age'        => random_int(10, 60),
            'address'    => $this->faker->address,
            'is_painful' => $this->faker->boolean,
            'purine'     => random_int(100, 1000),
        ];

        // Act
        $this->post(route('api.human.store'), $attribute);

        // Assert
        $this->assertDatabaseHas('humans', $attribute);
    }
}
