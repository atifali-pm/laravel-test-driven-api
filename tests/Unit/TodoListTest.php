<?php

namespace Tests\Unit;

use App\Models\Task;
use App\Models\TodoList;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class TodoListTest extends TestCase
{
    use RefreshDatabase;
    public function test_a_todo_list_can_have_many_tasks()
    {
        $todo_list = TodoList::factory()->create();
        $task = Task::factory()->create(['todo_list_id' => $todo_list->id]);

        $this->assertInstanceOf(Task::class, $todo_list->tasks->first());
    }
}
