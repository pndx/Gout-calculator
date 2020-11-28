<?php

namespace Tests\Feature\Http\Controllers\Api\V1\Auth;

use Artisan;
use Tests\TestCase;
use App\Models\User;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Foundation\Testing\RefreshDatabase;

class LoginControllerTest extends TestCase
{
    use RefreshDatabase, WithFaker;

    protected $user;
    protected $password;

    protected function setUp(): void
    {
        parent::setUp();
        Artisan::call('migrate', ['-vvv' => true]);
        Artisan::call('passport:install', ['-vvv' => true]);
        Artisan::call('db:seed', ['-vvv' => true]);

        $this->user = User::factory()->create([
            'email'    => $this->faker->unique()->safeEmail,
            'password' => bcrypt('password'),
        ]);
        $this->password = 'password';
    }

    /** @test */
    public function can_log_in_via_api(): void
    {
        // Act
        $response = $this->post(route('api.login'), [
            'email'    => $this->user->email,
            'password' => $this->password,
            ]);

        // Assert
        $response->assertSuccessful()->assertJsonStructure(['access_token']);
    }

    /** @test */
    public function cannot_log_in_with_illegal_credentials(): void
    {
        // Act
        $response = $this->post(route('api.login'), [
            'email'    => $this->user->email,
            'password' => 'wrong-password',
        ]);

        // Assert
        $response->assertSuccessful()->assertJson(['message' => 'Invalid login credentials.']);
    }
}
