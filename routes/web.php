<?php

use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AdminUserController;
use App\Http\Controllers\OjtProfileController;
use App\Http\Controllers\DailyLogController;

Route::middleware(['auth'])->group(function () {
    Route::get('/ojt-profile', [OjtProfileController::class, 'edit'])->name('ojt.profile.edit');
    Route::post('/ojt-profile', [OjtProfileController::class, 'update'])->name('ojt.profile.update');

    Route::get('/daily-logs/{daily_log}/issue-image', [DailyLogController::class, 'viewIssueImage'])->name('daily-logs.issue-image.view');
    Route::get('/daily-logs/{daily_log}/issue-image/download', [DailyLogController::class, 'downloadIssueImage'])->name('daily-logs.issue-image.download');
    Route::resource('/daily-logs', DailyLogController::class);
});

Route::middleware(['auth'])->prefix('admin')->name('admin.')->group(function () {
    Route::get('/users', [AdminUserController::class, 'index'])->name('users.index');
    Route::get('/users/create', [AdminUserController::class, 'create'])->name('users.create');
    Route::post('/users', [AdminUserController::class, 'store'])->name('users.store');
    Route::get('/users/{user}/reset-password', [AdminUserController::class, 'editPassword'])->name('users.password.edit');
    Route::put('/users/{user}/reset-password', [AdminUserController::class, 'updatePassword'])->name('users.password.update');
});

Route::get('/', function () {
    return view('welcome');
});

Route::get('/dashboard', function () {
    return view(auth()->user()->isAdmin() ? 'admin.dashboard' : 'dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

require __DIR__.'/auth.php';
