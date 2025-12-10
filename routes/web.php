<?php

use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\UserController;
use App\Http\Controllers\BudgetImportController;
use App\Http\Controllers\ProjectController;
use App\Http\Controllers\EstimatedBudgetController;
// Public Routes
Route::get('/', function () {
    return view('welcome');
});

Route::get('/dashboard', [UserController::class, 'home'])
    ->middleware(['auth', 'verified'])
    ->name('dashboard');

// Admin Routes – Protected by auth + admin middleware
Route::middleware(['auth', 'admin'])
    ->prefix('admin')
    ->name('admin.')
    ->group(function () {

        
        Route::get('dashboard', [UserController::class, 'dashboard'])->name('dashboard');
        // PROJECTS – SPECIFIC ROUTE (MUST BE FIRST)
        Route::get('projects', [ProjectController::class, 'index'])->name('projects.index');
        Route::get('projects/export', [ProjectController::class, 'export'])->name('projects.export');
        Route::post('projects/import', [ProjectController::class, 'import'])->name('projects.import');

        // USERS – DYNAMIC {id} (MUST BE AFTER)
        Route::get('users', [UserController::class, 'index'])->name('users.index');
        Route::get('users/create', [UserController::class, 'create'])->name('users.create');
        Route::post('users', [UserController::class, 'store'])->name('users.store');
        Route::get('users/{id}/edit', [UserController::class, 'edit'])->name('users.edit');
        Route::put('users/{id}', [UserController::class, 'update'])->name('users.update');
        Route::delete('users/{id}', [UserController::class, 'destroy'])->name('users.destroy');

        
    });

// Auth Routes (Breeze or Jetstream)
Route::middleware(['auth'])->group(function () {
    Route::prefix('user')->name('user.')->middleware('auth')->group(function () {

    Route::get('/estimated-budget/create', [EstimatedBudgetController::class, 'create'])
         ->name('estimated-budget.create');

    Route::post('/estimated-budget', [EstimatedBudgetController::class, 'store'])
         ->name('estimated-budget.store');

    Route::get('/estimated-budget/my-list', [EstimatedBudgetController::class, 'myList'])
         ->name('estimated-budget.my-list');
    Route::get('/estimated-budget/{id}', [EstimatedBudgetController::class, 'show'])
     ->name('estimated-budget.show');
    });
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

require __DIR__.'/auth.php';