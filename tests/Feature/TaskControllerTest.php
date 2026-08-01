<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use PHPUnit\Framework\Attributes\Test;
use Tests\TestCase;
use App\Models\User;
use App\Models\Task;

class TaskControllerTest extends TestCase
{
    use RefreshDatabase;

    #[Test]
    public function task_list_page_loads_with_tasks_and_employees()
    {
        $creator = User::factory()->create(['role' => 'admin']);
        $employee = User::factory()->create(['role' => 'user']);

        Task::factory()->create([
            'created_by' => $creator->id,
            'assigned_to' => $employee->id,
        ]);

        $response = $this->get('/tasks');

        $response->assertOk();
        $response->assertViewIs('tasks.index');
        $response->assertViewHas('tasks');
        $response->assertViewHas('employees');
    }

    #[Test]
    public function index_only_lists_users_with_role_user_as_employees()
    {
        $admin = User::factory()->create(['role' => 'admin']);
        $manager = User::factory()->create(['role' => 'manager']);
        $employee = User::factory()->create(['role' => 'user']);

        $response = $this->get('/tasks');

        $response->assertOk();
        $employees = $response->viewData('employees');

        $this->assertTrue($employees->contains('id', $employee->id));
        $this->assertFalse($employees->contains('id', $admin->id));
        $this->assertFalse($employees->contains('id', $manager->id));
    }

    #[Test]
    public function authenticated_user_can_create_a_task()
    {
        $creator = User::factory()->create(['role' => 'admin']);
        $employee = User::factory()->create(['role' => 'user']);

        $response = $this->withSession(['user_id' => $creator->id])
            ->post('/tasks', [
                'title' => 'Fix login bug',
                'description' => 'Login fails on invalid password',
                'assigned_to' => $employee->id,
                'priority' => 'high',
                'due_date' => now()->addDays(3)->format('Y-m-d'),
            ]);

        $response->assertRedirect();
        $response->assertSessionHas('success', 'Task created successfully');

        $this->assertDatabaseHas('tasks', [
            'title' => 'Fix login bug',
            'assigned_to' => $employee->id,
            'created_by' => $creator->id,
            'priority' => 'high',
        ]);
    }

    #[Test]
    public function task_creation_fails_with_missing_required_fields()
    {
        $creator = User::factory()->create(['role' => 'admin']);

        $response = $this->withSession(['user_id' => $creator->id])
            ->post('/tasks', []);

        $response->assertSessionHasErrors([
            'title',
            'assigned_to',
            'priority',
            'due_date',
        ]);

        $this->assertDatabaseCount('tasks', 0);
    }

    #[Test]
    public function task_creation_fails_with_invalid_priority()
    {
        $creator = User::factory()->create(['role' => 'admin']);
        $employee = User::factory()->create(['role' => 'user']);

        $response = $this->withSession(['user_id' => $creator->id])
            ->post('/tasks', [
                'title' => 'Fix login bug',
                'assigned_to' => $employee->id,
                'priority' => 'urgent', // not in low|medium|high
                'due_date' => now()->addDays(3)->format('Y-m-d'),
            ]);

        $response->assertSessionHasErrors(['priority']);
        $this->assertDatabaseCount('tasks', 0);
    }

    #[Test]
    public function task_creation_fails_when_assigned_to_does_not_exist()
    {
        $creator = User::factory()->create(['role' => 'admin']);

        $response = $this->withSession(['user_id' => $creator->id])
            ->post('/tasks', [
                'title' => 'Fix login bug',
                'assigned_to' => 99999,
                'priority' => 'high',
                'due_date' => now()->addDays(3)->format('Y-m-d'),
            ]);

        $response->assertSessionHasErrors(['assigned_to']);
        $this->assertDatabaseCount('tasks', 0);
    }

    #[Test]
    public function task_creation_fails_when_due_date_is_not_in_the_future()
    {
        $creator = User::factory()->create(['role' => 'admin']);
        $employee = User::factory()->create(['role' => 'user']);

        $response = $this->withSession(['user_id' => $creator->id])
            ->post('/tasks', [
                'title' => 'Fix login bug',
                'assigned_to' => $employee->id,
                'priority' => 'high',
                'due_date' => now()->format('Y-m-d'), // today, not "after:today"
            ]);

        $response->assertSessionHasErrors(['due_date']);
        $this->assertDatabaseCount('tasks', 0);
    }

    #[Test]
    public function task_creation_allows_nullable_description()
    {
        $creator = User::factory()->create(['role' => 'admin']);
        $employee = User::factory()->create(['role' => 'user']);

        $response = $this->withSession(['user_id' => $creator->id])
            ->post('/tasks', [
                'title' => 'No description task',
                'assigned_to' => $employee->id,
                'priority' => 'low',
                'due_date' => now()->addDay()->format('Y-m-d'),
            ]);

        $response->assertSessionHasNoErrors();
        $this->assertDatabaseHas('tasks', [
            'title' => 'No description task',
            'description' => null,
        ]);
    }

    #[Test]
    public function task_status_can_be_updated()
    {
        $creator = User::factory()->create(['role' => 'admin']);
        $employee = User::factory()->create(['role' => 'user']);

        $task = Task::factory()->create([
            'created_by' => $creator->id,
            'assigned_to' => $employee->id,
            'status' => 'pending',
        ]);

        $response = $this->post("/tasks/{$task->id}/status", [
            'status' => 'completed',
        ]);

        $response->assertRedirect();

        $this->assertDatabaseHas('tasks', [
            'id' => $task->id,
            'status' => 'completed',
        ]);
    }

    #[Test]
    public function status_update_fails_without_status_field()
    {
        $creator = User::factory()->create(['role' => 'admin']);
        $employee = User::factory()->create(['role' => 'user']);

        $task = Task::factory()->create([
            'created_by' => $creator->id,
            'assigned_to' => $employee->id,
            'status' => 'pending',
        ]);

        $response = $this->post("/tasks/{$task->id}/status", []);

        $response->assertSessionHasErrors(['status']);

        $this->assertDatabaseHas('tasks', [
            'id' => $task->id,
            'status' => 'pending', // unchanged
        ]);
    }

    #[Test]
    public function status_update_returns_404_for_nonexistent_task()
    {
        $response = $this->post('/tasks/99999/status', [
            'status' => 'completed',
        ]);

        $response->assertNotFound();
    }
}