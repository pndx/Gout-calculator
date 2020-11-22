<?php

namespace Tests\Feature\Http\Controllers\Api\V1\Human;

use Exception;
use Tests\TestCase;
use App\Models\User;
use App\Models\Human;
use Laravel\Passport\Passport;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Foundation\Testing\RefreshDatabase;

class HumanControllerTest extends TestCase
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
    public function a_human_can_be_added(): void
    {
        // Arrange
        $attribute = [
            'name'       => $this->faker->name,
            'age'        => $this->faker->randomNumber(2),
            'address'    => $this->faker->address,
            'is_painful' => $this->faker->boolean,
            'purine'     => $this->faker->randomNumber(2),
        ];

        // Act
        $this->post(route('api.human.store'), $attribute);

        // Assert
        $this->assertDatabaseHas('humans', $attribute);
    }

    /** @test */
    public function can_show_a_human(): void
    {
        // Arrange
        $human = Human::factory()->create();

        // Act
        $response = $this->get(route('api.human.show', $human->id));

        // Assert
        $response->assertSuccessful()->assertJsonStructure([
            'id',
            'name',
            'age',
            'address',
            'is_painful',
            'purine',
            'created_at',
            'updated_at',
        ]);
    }

    /** @test */
    public function cannot_show_a_human_with_wrong_id(): void
    {
        // Act
        $response = $this->get(route('api.human.show', 1));

        // Assert
        $response->assertStatus(404);

    }

    /** @test */
    public function can_get_human_list(): void
    {
        // Arrange
        Human::factory()->count(5)->create();

        // Act
        $response = $this->get(route('api.human.index'));

        // Assert
        $response->assertSuccessful()->assertJsonCount(5);
    }

    /** @test */
    public function can_update_human_information(): void
    {
        // Arrange
        $human = Human::factory()->create();
        $human->address = $this->faker->address;

        // Act
        $this->put(route('api.human.update', $human->id), $human->toArray());

        $this->assertDatabaseHas('humans', ['id' => $human->id, 'address' => $human->address]);
    }

    /** @test */
    public function cannot_update_human_information_when_not_exists(): void
    {
        // Arrange
        $human = Human::factory()->make();

        // Act
        $response = $this->put(route('api.human.update', 1), $human->toArray());

        // Assert
        $response->assertStatus(404);
    }

    /** @test */
    public function can_delete_human_by_id(): void
    {
        // Arrange
        $human = Human::factory()->create();

        // Act
        $this->delete(route('api.human.destroy', $human->id));

        // Assert
        $this->assertDatabaseMissing('humans', ['id' => $human->id]);
    }

    /** @test */
    public function cannot_delete_human_by_wrong_id(): void
    {
        // Act
        $response = $this->delete(route('api.human.destroy', 1));

        // Assert
        $response->assertStatus(404);
    }
}
