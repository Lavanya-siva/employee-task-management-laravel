<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use PHPUnit\Framework\Attributes\Test;
use PHPUnit\Framework\TestCase;
use App\Models\User;

class AdminManagerTest extends TestCase
{
    use RefreshDatabase;

    #[Test]
    public function guest_cannot_assign_manager()
    {
        $manager = User::factory()->create(['role' => 'manager']);
        $employee = User::factory()->create(['role' => 'user']);

        $response = $this->post('/manager-assignment', [
            'user_id' => $employee->id,
            'manager_id' => $manager->id,
        ]);

        $response->assertRedirect();
        $response->assertSessionHas('error', 'Only admin can assign managers');

        $this->assertDatabaseMissing('users', [
            'id' => $employee->id,
            'manager_id' => $manager->id,
        ]);
    }

    #[Test]
    public function non_admin_cannot_assign_manager()
    {
        /** @var \App\Models\User $user */
        $user = User::factory()->create(['role' => 'user']);
        $manager = User::factory()->create(['role' => 'manager']);
        $employee = User::factory()->create(['role' => 'user']);

        $response = $this->actingAs($user)->post('/manager-assignment', [
            'user_id' => $employee->id,
            'manager_id' => $manager->id,
        ]);

        $response->assertRedirect();
        $response->assertSessionHas('error', 'Only admin can assign managers');
    }

    #[Test]
    public function admin_can_assign_manager_to_employee()
    {
        /** @var \App\Models\User $admin */
        $admin = User::factory()->create(['role' => 'admin']);
        $manager = User::factory()->create(['role' => 'manager']);
        $employee = User::factory()->create(['role' => 'user']);

        $response = $this->actingAs($admin)->post('/manager-assignment', [
            'user_id' => $employee->id,
            'manager_id' => $manager->id,
        ]);

        $response->assertRedirect();
        $response->assertSessionHas('success', 'Manager assigned successfully');

        $this->assertDatabaseHas('users', [
            'id' => $employee->id,
            'manager_id' => $manager->id,
        ]);
    }

    #[Test]
    public function assignment_fails_when_manager_id_is_not_actually_a_manager()
    {
        /** @var \App\Models\User $admin */
        $admin = User::factory()->create(['role' => 'admin']);
        $notAManager = User::factory()->create(['role' => 'user']);
        $employee = User::factory()->create(['role' => 'user']);

        $response = $this->actingAs($admin)->post('/manager-assignment', [
            'user_id' => $employee->id,
            'manager_id' => $notAManager->id,
        ]);

        $response->assertRedirect();
        $response->assertSessionHas('error', 'Selected user is not a manager');

        $this->assertDatabaseMissing('users', [
            'id' => $employee->id,
            'manager_id' => $notAManager->id,
        ]);
    }

    #[Test]
    public function assignment_fails_when_user_id_is_not_actually_an_employee()
    {
        /** @var \App\Models\User $admin */
        $admin = User::factory()->create(['role' => 'admin']);
        $manager = User::factory()->create(['role' => 'manager']);
        $notAnEmployee = User::factory()->create(['role' => 'admin']);

        $response = $this->actingAs($admin)->post('/manager-assignment', [
            'user_id' => $notAnEmployee->id,
            'manager_id' => $manager->id,
        ]);

        $response->assertRedirect();
        $response->assertSessionHas('error', 'Invalid employee selected');
    }

    #[Test]
    public function assignment_fails_with_missing_fields()
    {
        /** @var \App\Models\User $admin */
        $admin = User::factory()->create(['role' => 'admin']);

        $response = $this->actingAs($admin)->post('/manager-assignment', []);

        $response->assertSessionHasErrors(['user_id', 'manager_id']);
    }

    #[Test]
    public function assignment_fails_with_nonexistent_ids()
    {
        /** @var \App\Models\User $admin */
        $admin = User::factory()->create(['role' => 'admin']);

        $response = $this->actingAs($admin)->post('/manager-assignment', [
            'user_id' => 99999,
            'manager_id' => 88888,
        ]);

        $response->assertSessionHasErrors(['user_id', 'manager_id']);
    }
}