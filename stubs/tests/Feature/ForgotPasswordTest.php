<?php

namespace Tests\Feature;

use App\Models\User;
use Illuminate\Auth\Notifications\ResetPassword;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Support\Facades\Notification;
use Tests\TestCase;

class ForgotPasswordTest extends TestCase
{
    use RefreshDatabase;

    /**
     * @test
     */
    public function forgotPasswordPageIsAccessible()
    {
        $response = $this->get(route('forgot.password'));

        $response->assertStatus(200);
    }

    /**
     * @test
     */
    public function resetPasswordLinkCanBeRequested()
    {
        Notification::fake();

        $user = User::factory()->create();

        $this->post(route('forgot.password.store'), ['email' => $user->email]);

        Notification::assertSentTo($user, ResetPassword::class);
    }
}
