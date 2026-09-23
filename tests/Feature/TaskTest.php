<?php

namespace Tests\Feature;

use App\Models\Task;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class TaskTest extends TestCase
{
    use RefreshDatabase;

    public function test_task_index_page_loads(): void
    {
        $response = $this->get('/tasks');

        $response->assertOk();
        $response->assertSee('Task Manager');
    }

    public function test_user_can_create_a_task(): void
    {
        $response = $this->post('/tasks', [
            'task_name' => 'Write project report',
            'description' => 'Finish the weekly status update.',
            'status' => 'Pending',
            'due_date' => '2026-10-05',
        ]);

        $response->assertRedirect('/tasks');
        $this->assertDatabaseHas('tasks', [
            'task_name' => 'Write project report',
            'status' => 'Pending',
        ]);
    }

    public function test_user_can_update_a_task(): void
    {
        $task = Task::create([
            'task_name' => 'Old task',
            'description' => 'Old description',
            'status' => 'Pending',
            'due_date' => '2026-09-30',
        ]);

        $response = $this->put("/tasks/{$task->id}", [
            'task_name' => 'Updated task',
            'description' => 'Updated description',
            'status' => 'Completed',
            'due_date' => '2026-10-10',
        ]);

        $response->assertRedirect('/tasks');
        $this->assertDatabaseHas('tasks', [
            'id' => $task->id,
            'task_name' => 'Updated task',
            'status' => 'Completed',
        ]);
    }

    public function test_user_can_delete_a_task(): void
    {
        $task = Task::create([
            'task_name' => 'Delete me',
            'description' => 'This task will be removed.',
            'status' => 'Pending',
            'due_date' => '2026-09-25',
        ]);

        $response = $this->delete("/tasks/{$task->id}");

        $response->assertRedirect('/tasks');
        $this->assertDatabaseMissing('tasks', [
            'id' => $task->id,
        ]);
    }
}
