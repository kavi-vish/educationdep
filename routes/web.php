<?php

use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\UserController;
use App\Http\Controllers\BudgetImportController;
use App\Http\Controllers\ProjectController;
use App\Http\Controllers\EstimatedBudgetController;
use App\Http\Controllers\User\ActualBudgetController;
use App\Http\Controllers\AdminBudgetController;

// Public Routes
Route::get('/', function () {
    return view('welcome');
});

Route::middleware(['auth'])->group(function () {
    Route::get('/zonal/dashboard', function () {
        return view('zonal.dashboard');
    })->name('zonal.dashboard');
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
        
        // Estimated
    Route::get('/estimated-budgets', [AdminBudgetController::class, 'estimatedList'])->name('estimated.list');
    Route::get('/estimated-budgets/{id}', [AdminBudgetController::class, 'estimatedShow'])->name('estimated.show');
    Route::post('/estimated-budgets/{id}/approve', [AdminBudgetController::class, 'estimatedApprove'])->name('estimated.approve');
    Route::post('/estimated-budgets/{id}/reject', [AdminBudgetController::class, 'estimatedReject'])->name('estimated.reject');

    // Actual
    Route::get('/actual-budgets', [AdminBudgetController::class, 'actualList'])->name('actual.list');
    Route::get('/actual-budgets/{id}', [AdminBudgetController::class, 'actualShow'])->name('actual.show');
    Route::post('/actual-budgets/{id}/approve', [AdminBudgetController::class, 'actualApprove'])->name('actual.approve');
    Route::post('/actual-budgets/{id}/reject', [AdminBudgetController::class, 'actualReject'])->name('actual.reject');
        
    Route::get('/votes', [AdminBudgetController::class, 'voteManagement'])->name('votes.index');
    Route::post('/votes/create', [AdminBudgetController::class, 'createVote'])->name('votes.create');
    Route::post('/votes/fund/add', [AdminBudgetController::class, 'addFund'])->name('votes.fund.add');
    });

// ====================== ACCOUNTANT ROUTES ======================
Route::prefix('accountant')->name('accountant.')->middleware(['auth'])->group(function () {
    Route::get('/dashboard', [App\Http\Controllers\AccountantController::class, 'dashboard'])
         ->name('dashboard');
    Route::get('/approved-estimated-budgets', [App\Http\Controllers\AccountantController::class, 'approvedEstimated'])
         ->name('estimated.approved');
    Route::get('/approved-estimated-budgets/{id}', [App\Http\Controllers\AccountantController::class, 'showEstimated'])
     ->name('estimated.show');
});

Route::middleware(['auth'])->group(function () {
    Route::prefix('user')->name('user.')->middleware('auth')->group(function () {
    Route::get('/actual-budget/create', [ActualBudgetController::class, 'create'])
         ->name('actual-budget.create');
    Route::post('/actual-budget/store', [ActualBudgetController::class, 'store'])
         ->name('actual-budget.store');
    Route::get('/actual-budget/my-list', [ActualBudgetController::class, 'myList'])
         ->name('actual-budget.my-list');
    Route::get('/actual-budget/{id}', [ActualBudgetController::class, 'show'])
         ->name('actual-budget.show');
   
    

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