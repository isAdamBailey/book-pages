<?php

namespace Tests\Feature;

use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class UserPermissionsTest extends TestCase
{
    use RefreshDatabase;

    public function test_users_permissions_are_updated()
    {
        $this->actingAs($user = User::factory()->create());
        $user->givePermissionTo('edit pages');

        $editUser = User::factory()->create();
        $this->assertFalse($editUser->hasPermissionTo('edit pages'));

        $payload = [
            'user' => $editUser->toArray(),
            'permissions' => ['edit pages']
        ];
        $response = $this->put(route('users.permissions'), $payload);

        $this->assertTrue($editUser->fresh()->hasPermissionTo('edit pages'));

        $response->assertRedirect(route('dashboard'));
    }

    public function test_users_permissions_are_revoked()
    {
        $this->actingAs($user = User::factory()->create());
        $user->givePermissionTo('edit pages');

        $editUser = User::factory()->create();
        $editUser->givePermissionTo('edit pages');
        $this->assertTrue($editUser->hasPermissionTo('edit pages'));

        $payload = [
            'user' => $editUser->toArray(),
            'permissions' => []
        ];
        $response = $this->put(route('users.permissions'), $payload);

        $this->assertFalse($editUser->fresh()->hasPermissionTo('edit pages'));

        $response->assertRedirect(route('dashboard'));
    }
}
