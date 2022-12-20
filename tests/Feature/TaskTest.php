<?php

namespace Tests\Feature;

use App\Models\Task;
use App\Models\TodoList;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class TaskTest extends TestCase
{
    use RefreshDatabase;

    public function test_fetch_all_tasks()
    {
        $task = Task::factory()->create();
        $list = TodoList::factory()->create();

        $response = $this->getJson(route('task.index', $list->id))
            ->assertOk()
            ->json();


        $this->assertEquals(1, count($response));
        $this->assertEquals($task->title, $response[0]['title']);
    }

    public function test_store_task_in_todo_list()
    {
        $list = TodoList::factory()->create();
        $task = Task::factory()->make();

        $response = $this->postJson(route('task.store', $list->id), ['title' => $task->title])
            ->assertCreated()
            ->json();

        $this->assertDatabaseHas('tasks', ['todo_list_id' => $list->id, 'title' => $task->title]);
    }

    public function test_remove_a_task()
    {
        $task = Task::factory()->create();

        $this->deleteJson(route('task.destroy', $task->id))
            ->assertNoContent();

        $this->assertDatabaseMissing('tasks', ['id' => $task->id]);

    }
}
