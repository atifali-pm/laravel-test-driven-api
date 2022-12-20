<?php

namespace App\Http\Controllers;

use App\Models\Task;
use App\Models\TodoList;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class TaskController extends Controller
{
    public function index(TodoList $todoList)
    {
        $tasks = $todoList->tasks; //Task::where(['todo_list_id' => $todoList->id])->get();
        return response($tasks);
    }

    public function store(Request $request, TodoList $todo_list)
    {
        return $todo_list->tasks()->create($request->all());
    }

    public function destroy(Task $task)
    {
        $task->delete();
        return response('', Response::HTTP_NO_CONTENT);
    }
}
