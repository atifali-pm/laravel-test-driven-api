<?php

namespace App\Http\Controllers;

use App\Models\TodoList;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class TodoListController extends Controller
{
    public function index()
    {
        $lists = TodoList::all();
        return response(['list' => $lists]);
    }

    public function show(TodoList $todolist)
    {
        //$list = TodoList::findOrFail($todolist);
        return response($todolist);
    }

    public function store(Request $request)
    {
        $list = TodoList::create($request->all());
        return $list;
    }
}