<?php

namespace Tests\Feature\Http\Controllers\Api\V1\Auth;

use Artisan;
use Tests\TestCase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Foundation\Testing\RefreshDatabase;

class RegisterControllerTest extends TestCase
{
    use RefreshDatabase, WithFaker;

    protected function setUp(): void
    {
        parent::setUp();
        Artisan::call('migrate', ['-vvv' => true]);
        Artisan::call('passport:install', ['-vvv' => true]);
        Artisan::call('db:seed', ['-vvv' => true]);
    }

    /** @test */
    public function can_be_registered_via_api(): void
    {
        // Arrange
        $name     = $this->faker->name;
        $email    = $this->faker->unique()->email;
        $password = $this->faker->password(8);

        // Act
        $response = $this->post(route('api.register'), [
            'name'                  => $name,
            'email'                 => $email,
            'password'              => $password,
            'password_confirmation' => $password,
        ]);

        // Assert
        $response->assertSuccessful()->assertJsonStructure(['user', 'access_token']);
    }
}
