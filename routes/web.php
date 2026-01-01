<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\MoodController;
use App\Http\Controllers\JournalController;
use App\Http\Controllers\WellnessGoalController;
use App\Http\Controllers\ResourceController;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\AdminController;
use App\Http\Controllers\DoctorController;
use App\Http\Controllers\ChatController;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
*/

// Auth Routes
Route::get('/login', [AuthController::class, 'showLogin'])->name('login');
Route::post('/login', [AuthController::class, 'login'])->name('login.post');
Route::get('/register', [AuthController::class, 'showRegister'])->name('register');
Route::post('/register', [AuthController::class, 'register'])->name('register.post');
Route::post('/logout', [AuthController::class, 'logout'])->name('logout');

// Protected Routes
Route::middleware(['auth'])->group(function () {
    
    // Main Redirect
    Route::get('/', function () {
        $user = auth()->user();
        if ($user->role === 'admin') return redirect()->route('admin.dashboard');
        if ($user->role === 'doctor') return redirect()->route('doctor.dashboard');
        return redirect()->route('student.dashboard');
    });

    // Student Dashboard
    Route::get('/dashboard', [DashboardController::class, 'index'])->name('student.dashboard');

    // Public Tools (Available to Students/Doctors)
    Route::get('/mood', [MoodController::class, 'index'])->name('mood.index');
    Route::post('/mood', [MoodController::class, 'store'])->name('mood.store');
    
    Route::get('/journal', [JournalController::class, 'index'])->name('journal.index');
    Route::post('/journal', [JournalController::class, 'store'])->name('journal.store');
    
    Route::get('/goals', [WellnessGoalController::class, 'index'])->name('goals.index');
    Route::post('/goals', [WellnessGoalController::class, 'store'])->name('goals.store');
    
    Route::get('/resources', [ResourceController::class, 'index'])->name('resources.index');

    // Admin Routes
    Route::prefix('admin')->middleware('role.admin')->group(function () {
        Route::get('/', [AdminController::class, 'index'])->name('admin.dashboard');
        Route::post('/approve/{id}', [AdminController::class, 'toggleApproval'])->name('admin.approve');
        Route::delete('/delete/{id}', [AdminController::class, 'destroy'])->name('admin.delete');
    });

    // Doctor Routes
    Route::prefix('doctor')->middleware('role.doctor')->group(function () {
        Route::get('/', [DoctorController::class, 'index'])->name('doctor.dashboard');
        // Simple alias for chat in doctor context
        Route::get('/chat', [ChatController::class, 'index'])->name('doctor.chat');
    });

    // Chat Routes (Shared by all auth users)
    Route::get('/chat', [ChatController::class, 'index'])->name('chat.index');
    Route::get('/chat/{id}', [ChatController::class, 'show'])->name('chat.show');
    Route::post('/chat/{id}', [ChatController::class, 'store'])->name('chat.store');

});
