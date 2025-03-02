<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ProjectController;
use App\Http\Controllers\TaskController;


/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "api" middleware group. Make something great!
|
*/

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});

Route::get('/projects', [ProjectController::class, 'allProjects'])->name('project.list');
Route::get('/projects/{id}', [ProjectController::class, 'showProject'])->name('project.show');
Route::post('/projects', [ProjectController::class, 'postProject'])->name('project.create');

Route::post('/tasks', [TaskController::class, 'postTask'])->name('task.create');
Route::put('/tasks/{id}', [TaskController::class, 'updateTask'])->name('task.update');
Route::get('/tasks/{id}', [TaskController::class, 'showTask'])->name('task.show');
Route::get('/projects/{projectId}/tasks', [TaskController::class, 'allProjectTasks'])->name('task.list');
Route::delete('/tasks/{id}', [TaskController::class, 'deleteTask'])->name('task.delete');
Route::post('/tasks/update-order', [TaskController::class, 'updateOrder'])->name('task.order');