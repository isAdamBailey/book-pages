<?php

namespace Tests\Feature\Auth;

use App\Models\User;
use App\Providers\RouteServiceProvider;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Inertia\Testing\AssertableInertia as Assert;
use Tests\TestCase;

class AuthenticationTest extends TestCase
{
    use RefreshDatabase;

    public function test_login_screen_can_be_rendered()
    {
        $response = $this->get('/login');

        $response->assertStatus(200);
    }

    public function test_users_can_authenticate_using_the_login_screen()
    {
        $user = User::factory()->create();

        $response = $this->post('/login', [
            'email' => $user->email,
            'password' => 'password',
        ]);

        $this->assertAuthenticated();
        $response->assertRedirect(RouteServiceProvider::HOME);
    }

    public function test_users_can_not_authenticate_with_invalid_password()
    {
        $user = User::factory()->create();

        $this->post('/login', [
            'email' => $user->email,
            'password' => 'wrong-password',
        ]);

        $this->assertGuest();
    }

    public function test_user_inertia_response_for_logged_in_user()
    {
        $this->actingAs($user = User::factory()->create());

        $this->get('/dashboard')->assertInertia(
            fn (Assert $page) => $page
                ->component('Dashboard/Index')
                ->url('/dashboard')
                ->has('auth.user.permissions_list', 0)
        );

        // user with page editing permissions
        $user2 = User::factory()->create();
        $user2->givePermissionTo('edit pages');
        $this->actingAs($user2);

        $this->get('/dashboard')->assertInertia(
            fn (Assert $page) => $page
                ->component('Dashboard/Index')
                ->url('/dashboard')
                ->has('auth.user.permissions_list', 1)
        );
    }
}
