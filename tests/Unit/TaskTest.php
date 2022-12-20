<?php

namespace Tests\Unit;

use App\Models\Task;
use App\Models\TodoList;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class TaskTest extends TestCase
{
    use RefreshDatabase;
    public function test_task_belongs_to_todo_list()
    {
        $todo_list = TodoList::factory()->create();
        $task = Task::factory()->create(['todo_list_id' => $todo_list->id]);

        $this->assertInstanceOf(TodoList::class, $task->todo_list);
    }
}
