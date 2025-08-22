<?php

use App\Http\Controllers\ProfileController;
use App\Http\Controllers\Admin\DashboardController;
use App\Http\Controllers\Admin\BookController;
use App\Http\Controllers\MemberController;
use App\Http\Controllers\LoanController;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('welcome');
});

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

// Admin Routes
Route::middleware(['auth', 'admin'])->prefix('admin')->group(function () {
    Route::get('/', function() {
        return redirect()->route('admin.dashboard');
    });
    Route::get('/dashboard', [DashboardController::class, 'index'])->name('admin.dashboard');
    
    // Books Management
    Route::resource('books', BookController::class)->names([
        'index' => 'admin.books.index',
        'create' => 'admin.books.create',
        'store' => 'admin.books.store',
        'show' => 'admin.books.show',
        'edit' => 'admin.books.edit',
        'update' => 'admin.books.update',
        'destroy' => 'admin.books.destroy',
    ]);
    
    // Members Management
    Route::resource('members', MemberController::class)->names([
        'index' => 'admin.members.index',
        'create' => 'admin.members.create',
        'store' => 'admin.members.store',
        'show' => 'admin.members.show',
        'edit' => 'admin.members.edit',
        'update' => 'admin.members.update',
        'destroy' => 'admin.members.destroy',
    ]);
    
    // Loans Management
    Route::resource('loans', LoanController::class)->names([
        'index' => 'admin.loans.index',
        'create' => 'admin.loans.create',
        'store' => 'admin.loans.store',
        'show' => 'admin.loans.show',
        'edit' => 'admin.loans.edit',
        'update' => 'admin.loans.update',
        'destroy' => 'admin.loans.destroy',
    ]);
});

require __DIR__.'/auth.php';
