<?php

namespace Tests\Feature;

use App\Providers\RouteServiceProvider;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class RegistrationTest extends TestCase
{
    use RefreshDatabase;

    /**
     * @test
     */
    public function registrationPageIsAccessible()
    {
        $response = $this->get(route('register'));

        $response->assertStatus(200);
    }

    /**
     * @test
     */
    public function guestUserCanRegister()
    {
        $response = $this->post(route('register.submit'), [
            'name' => 'User',
            'email' => 'user@user.com',
            'password' => 'password',
            'password_confirmation' => 'password'
        ]);

        $this->assertAuthenticated();

        $response->assertRedirect(RouteServiceProvider::HOME);
    }
}
