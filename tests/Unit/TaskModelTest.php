<?php

namespace Tests\Unit;

use Illuminate\Foundation\Testing\RefreshDatabase;
use PHPUnit\Framework\Attributes\Test;
use PHPUnit\Framework\TestCase;
use App\Models\User;
use App\Models\Task;

class TaskModelTest extends TestCase
{
    use RefreshDatabase;

    #[Test]
    public function task_belongs_to_an_employee_via_assigned_to()
    {
        $employee = User::factory()->create(['role' => 'user']);
        $creator = User::factory()->create(['role' => 'admin']);

        $task = Task::factory()->create([
            'created_by' => $creator->id,
            'assigned_to' => $employee->id,
        ]);

        $this->assertInstanceOf(User::class, $task->employee);
        $this->assertEquals($employee->id, $task->employee->id);
    }

    #[Test]
    public function task_belongs_to_a_creator()
    {
        $employee = User::factory()->create(['role' => 'user']);
        $creator = User::factory()->create(['role' => 'admin']);

        $task = Task::factory()->create([
            'created_by' => $creator->id,
            'assigned_to' => $employee->id,
        ]);

        $this->assertInstanceOf(User::class, $task->creator);
        $this->assertEquals($creator->id, $task->creator->id);
    }

    #[Test]
    public function tasks_are_ordered_latest_first()
    {
        $creator = User::factory()->create(['role' => 'admin']);
        $employee = User::factory()->create(['role' => 'user']);

        $older = Task::factory()->create([
            'created_by' => $creator->id,
            'assigned_to' => $employee->id,
            'created_at' => now()->subDay(),
        ]);

        $newer = Task::factory()->create([
            'created_by' => $creator->id,
            'assigned_to' => $employee->id,
            'created_at' => now(),
        ]);

        $tasks = Task::latest()->get();

        $this->assertEquals($newer->id, $tasks->first()->id);
    }
}