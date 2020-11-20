<?php

namespace Tests\Feature\Http\Controllers\Auth;

use Tests\TestCase;
use App\Models\User;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Foundation\Testing\RefreshDatabase;

class LoginControllerTest extends TestCase
{
    use RefreshDatabase, WithFaker;

    /** @test */
    public function login_form_displayed(): void
    {
        // Act
        $response = $this->get(route('login'));

        // Assert
        $response->assertStatus(200);
        $response->assertViewIs('auth.login');
    }

    /** @test */
    public function cannot_logging_in_with_empty_data(): void
    {
        // Arrange
        $parameters = [];

        // Act
        $response = $this->post(route('login'), $parameters);

        // Assert
        $response->assertStatus(302);
        $response->assertSessionHasErrors('email');
    }

    /** @test */
    public function legal_users_can_logging_in(): void
    {
        // Arrange
        $user = User::factory()->create([
            'email'    => $this->faker->unique()->safeEmail,
            'password' => bcrypt('password'),
        ]);

        // Act
        $response = $this->post(route('login'), [
            'email'    => $user->email,
            'password' => 'password',
        ]);

        // Assert
        $response->assertRedirect(route('home'));
        $this->assertAuthenticatedAs($user);
    }

    /** @test */
    public function logging_in_with_invalid_credentials(): void
    {
        // Arrange
        $user = User::factory()->create([
            'email'    => $this->faker->unique()->safeEmail,
            'password' => bcrypt('password'),
        ]);

        // Act
        $response = $this->from(route('login'))->post(route('login'), [
            'email'    => $user->email,
            'password' => 'wrong-password',
        ]);

        // Assert
        $response->assertRedirect(route('login'));
    }
}
