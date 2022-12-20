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
        $tasks = Task::all();
        return response($tasks);
    }

    public function store(Request $request, TodoList $todo_list)
    {
        $request['todo_list_id'] = $todo_list->id;
        $task = Task::create($request->all());
        return $task;
    }

    public function destroy(Task $task)
    {
        $task->delete();
        return response('', Response::HTTP_NO_CONTENT);
    }
}
