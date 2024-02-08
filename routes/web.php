<?php

use App\Http\Controllers\ProjectsController;
use App\Http\Controllers\TasksController;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/
Route::get('/', function () {
    return redirect('/projects');
});

Route::prefix('/projects')->group(function () {
    Route::get('/', [ProjectsController::class, 'index']);
    Route::get('/{id}/tasks', [TasksController::class, 'index'])->name('project.tasks');
    Route::get('/{projectId}/tasks/form', [TasksController::class, 'form'])->name('task.form');
});

Route::prefix('/tasks')->group(function () {
    Route::get('/{taskId}/form', [TasksController::class, 'updateForm'])->name('tasks.form');
    Route::post('/', [TasksController::class, 'store'])->name('tasks.save');
    Route::put('/', [TasksController::class, 'update'])->name('tasks.update');
    Route::post('/sort', [TasksController::class, 'sort'])->name('tasks.sort');
    Route::get('/{id}/destroy', [TasksController::class, 'destroy'])->name('tasks.delete');
});
