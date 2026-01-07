<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;
use App\Models\User;
use App\Models\Document;
use Laravel\Sanctum\Sanctum;

class AdminManagerTest extends TestCase
{
    use RefreshDatabase;

    /** @test */
    public function unauthenticated_user_cannot_access_admin_routes()
    {
        $this->postJson('/api/admin/assign-manager', [])
            ->assertStatus(401);
        $this->getJson('/api/admin/users-personal-info')
            ->assertStatus(401);
        $this->postJson('/api/admin/set-document-status', [])
            ->assertStatus(401);
        $this->getJson('/api/admin/final-status/1')
            ->assertStatus(401);
    }

    /** @test */
    public function admin_can_assign_manager_to_user()
    {
        $admin = User::factory()->create(['role' => 'admin']);
        $manager = User::factory()->create(['role' => 'manager']);
        $user = User::factory()->create(['role' => 'user']);

        Sanctum::actingAs($admin);

        $response = $this->postJson('/api/admin/assign-manager', [
            'user_id' => $user->id,
            'manager_id' => $manager->id,
        ]);

        $response->assertStatus(200)
                 ->assertJson([
                     'success' => true,
                     'message' => 'Manager assigned to user successfully'
                 ]);

        $this->assertDatabaseHas('users', [
            'id' => $user->id,
            'manager_id' => $manager->id
        ]); // fail throw exception
    }

    /** @test */
    public function admin_cannot_assign_manager_if_role_wrong()
    {
        $admin = User::factory()->create(['role' => 'admin']);
        $anotherAdmin = User::factory()->create(['role' => 'admin']);
        $user = User::factory()->create(['role' => 'user']);

        Sanctum::actingAs($admin);

        $response = $this->postJson('/api/admin/assign-manager', [
            'user_id' => $user->id,
            'manager_id' => $anotherAdmin->id,
        ]);

        $response->assertStatus(404)
                 ->assertJson([
                     'success' => false,
                     'message' => 'Manager not found or not a manager.'
                 ]);
    }

    /** @test */
    public function manager_can_view_only_assigned_users()
    {
        $manager = User::factory()->create(['role' => 'manager']);
        $user1 = User::factory()->create(['role' => 'user', 'manager_id' => $manager->id]);
        $user2 = User::factory()->create(['role' => 'user', 'manager_id' => null]);

        Sanctum::actingAs($manager);

        $response = $this->getJson('/api/manager/users-personal-info');

        $response->assertStatus(200)
                 ->assertJsonCount(1, 'data')
                 ->assertJsonFragment([
                     'id' => $user1->id
                 ])
                 ->assertJsonMissing([
                     'id' => $user2->id
                 ]);
    }

    /** @test */
    public function cannot_assign_invalid_manager_or_user()
    {
        $admin = User::factory()->create(['role' => 'admin']);
        Sanctum::actingAs($admin);
        $response = $this->postJson('/api/admin/assign-manager', [
            'user_id' => 4,   
            'manager_id' => 8888 
        ]); // any one invalid

        $response->assertStatus(404)
                 ->assertJson([
                     'success' => false
                 ]);
    }
}
// csv  deployment cache