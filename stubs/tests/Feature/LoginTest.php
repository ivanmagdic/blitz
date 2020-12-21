<?php

namespace Tests\Feature;

use App\Models\User;
use App\Providers\RouteServiceProvider;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class LoginTest extends TestCase
{
    use RefreshDatabase;

    /**
     * @test
     */
    public function loginPageIsAccessible()
    {
        $response = $this->get(route('login'));

        $response->assertStatus(200);
    }

    /**
     * @test
     */
    public function guestUserCanLogin()
    {
        $user = User::factory()->create();

        $response = $this->post(route('login.submit'), [
            'email' => $user->email,
            'password' => 'password'
        ]);

        $this->assertAuthenticated();

        $response->assertRedirect(RouteServiceProvider::HOME);
    }

    /**
     * @test
     */
    public function guestUserCannotLoginWithInvalidCredentials()
    {
        $user = User::factory()->create();

        $this->post(route('login.submit'), [
            'email' => $user->email,
            'password' => 'credentials'
        ]);

        $this->assertGuest();
    }
}
