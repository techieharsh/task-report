<?php

use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\Manager\ProjectController;
use App\Models\Project;
use App\Models\Task;

// Route::get('/', function () {
//     return view('login');
// });

Route::get('/', function () {
    $projects = Project::withCount('tasks')->latest()->get();
    $tasks = Task::with('project')->latest()->get();

    return view('welcome', compact('projects', 'tasks'));
});

// Route::get('/dashboard', function () {
//     return view('dashboard');
// })->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
    
    Route::get('/dashboard', [DashboardController::class, 'index'])
        ->name('dashboard');

    // Role with manager
    Route::middleware(['role:manager'])
        ->prefix('manager')
        ->name('manager.')
        ->group(function () {

            Route::resource('projects', ProjectController::class);
            Route::resource('tasks', TaskController::class);
        });
    
    // Role with employee
    Route::middleware(['role:employee'])
        ->prefix('employee')
        ->name('employee.')
        ->group(function () {

            Route::get('/tasks', [EmployeeTaskController::class, 'index'])->name('tasks.index');
            Route::get('/tasks/{task}', [EmployeeTaskController::class, 'show'])->name('tasks.show');
        });
});

require __DIR__.'/auth.php';
