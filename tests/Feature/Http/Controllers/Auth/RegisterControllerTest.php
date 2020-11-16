<?php

namespace Tests\Feature\Http\Controllers\Auth;

use Tests\TestCase;
use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;

class RegisterControllerTest extends TestCase
{
    use RefreshDatabase;

    public function testRegisterFormDisplayed()
    {
        $response = $this->get('/register');

        $response->assertStatus(200);
    }

    public function testRegisterAValidUser()
    {
        $user = User::factory()->create();

        $response = $this->post('register', [
            'name'                  => $user->name,
            'email'                 => $user->email,
            'password'              => 'password',
            'password_confirmation' => 'password',
        ]);

        $response->assertStatus(302);

        $this->seeIsAuthenticated();
    }
}
