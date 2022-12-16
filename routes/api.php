<?php

use App\Http\Controllers\TaskController;
use App\Http\Controllers\TodoListController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

Route::resource('todo-list', TodoListController::class);

//Route::get('todo-list', [TodoListController::class, 'index'])->name('todo-list.index');
//Route::get('todo-list/{todolist}', [TodoListController::class, 'show'])->name('todo-list.show');
//Route::post('todo-list', [TodoListController::class, 'store'])->name('todo-list.store');
//Route::delete('todo-list/{list}', [TodoListController::class, 'destroy'])->name('todo-list.destroy');
//Route::patch('todo-list/{list}', [TodoListController::class, 'update'])->name('todo-list.update');

Route::get('task', [TaskController::class, 'index'])->name('task.index');
