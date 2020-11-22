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

    /**
     * @test
     * @throws Exception
     */
    public function a_human_can_be_added(): void
    {
        // Arrange
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
            'created_at',
            'address',
            'is_painful',
            'purine',
            'updated_at',
        ]);
    }

    /** @test
     * @throws Exception
     */
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
        $updatedAddress = $this->faker->address;

        $human->address = $updatedAddress;
        // Act
        $this->put(route('api.human.update', $human->id), $human->toArray());

        $this->assertDatabaseHas('humans', ['id' => $human->id, 'address' => $updatedAddress]);
    }
}
