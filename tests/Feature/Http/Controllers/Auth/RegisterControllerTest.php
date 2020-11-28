<?php

namespace Tests\Feature\Http\Controllers\Auth;

use Auth;
use Tests\TestCase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Foundation\Testing\RefreshDatabase;

class RegisterControllerTest extends TestCase
{
    use RefreshDatabase, WithFaker;

    /** @test */
    public function register_form_displayed(): void
    {
        $response = $this->get(route('register'));

        $response->assertStatus(200);
    }

    /** @test */
    public function able_to_register_a_user(): void
    {
        // Arrange
        $name     = $this->faker->name;
        $email    = $this->faker->unique()->safeEmail;
        $password = $this->faker->password(8);

        // Act
        $response = $this->post(route('register'), [
            'name'                  => $name,
            'email'                 => $email,
            'password'              => $password,
            'password_confirmation' => $password,
        ]);

        // Assert
        $response->assertStatus(302);
        $response->assertRedirect(route('home'));
        $this->assertAuthenticatedAs(Auth::user());
    }
}
