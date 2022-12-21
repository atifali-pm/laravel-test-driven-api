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

    public function test_fetch_all_tasks_of_a_todo_list()
    {
        $list = TodoList::factory()->create();
        $task = Task::factory()->create(['todo_list_id' => $list->id]);
        Task::factory()->create();

        $response = $this->getJson(route('task.index', $list->id))
            ->assertOk()
            ->json();

        //dd($response);


        $this->assertEquals(1, count($response));
        $this->assertEquals($task->title, $response[0]['title']);
        $this->assertEquals($task->todo_list_id, $response[0]['todo_list_id']);
    }

    public function test_store_task_in_a_todo_list()
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

    public function test_update_a_task_of_a_todo_list()
    {
        $todo_list = TodoList::factory()->create();
        $task = Task::factory()->create(['todo_list_id' => $todo_list->id]);

        $response = $this->patchJson(route('task.update', $task->id), ['title' => 'Task updated'])
            ->assertOk()
            ->json();

        $this->assertEquals('Task updated', $response['title']);
        $this->assertDatabaseHas('tasks', ['title' => 'Task updated']);

    }

    public function test_a_task_can_be_completed()
    {
        $task = Task::factory()->create();

        $response = $this->patchJson(route('task.complete', $task->id), ['is_completed' => true])
            ->assertOk()
            ->json();

        $this->assertEquals(true, $response['is_completed']);
    }
}
