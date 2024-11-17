<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\TodoController;

Route::get('/todos', [TodoController::class, 'index']); // Get all todos
Route::post('/todos', [TodoController::class, 'store']); // Create a new todo
Route::put('/todos/{todo}', [TodoController::class, 'update']); // Update a todo
Route::delete('/todos/{todo}', [TodoController::class, 'destroy']); // Delete a todo