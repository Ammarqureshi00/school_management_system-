<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\LoginController;
use App\Http\Controllers\RegisterController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\ForgotPasswordController;
use App\Http\Controllers\ResetPasswordController;
use App\Http\Controllers\SuperAdmin\ManageStudentController;
use App\Http\Controllers\SuperAdmin\ManageTeacherController;
use App\Http\Controllers\SuperAdmin\ManageUserController;


Route::get('/', function () {
    return view('welcome');
});
// -------------------- DASHBOARD --------------------
Route::middleware(['auth'])->group(function () {
    Route::get('/dashboard', [DashboardController::class, 'index'])->name('dashboard');
    Route::get('/dashboard/superadmin', [DashboardController::class, 'superadmin'])->name('dashboard.superadmin');
    Route::get('/dashboard/admin', [DashboardController::class, 'admin'])->name('dashboard.admin');
    Route::get('/dashboard/teacher', [DashboardController::class, 'teacher'])->name('dashboard.teacher');
    Route::get('/dashboard/student', [DashboardController::class, 'student'])->name('dashboard.student');
});

// -------------------- AUTH --------------------
Route::get('/login', [LoginController::class, 'showLoginForm'])->name('login');
Route::post('/login', [LoginController::class, 'login']);
Route::post('/logout', [LoginController::class, 'logout'])->name('logout');;

Route::get('/register', [RegisterController::class, 'showRegistrationForm'])->name('register');
Route::post('/register', [RegisterController::class, 'register']);


// Show forgot password form
Route::get('forgot-password', [ForgotPasswordController::class, 'showLinkRequestForm'])
    ->name('password.request');

// Handle sending reset link
Route::post('forgot-password', [ForgotPasswordController::class, 'sendResetLinkEmail'])
    ->name('password.email');

// Show reset password form
Route::get('reset-password/{token}', [ResetPasswordController::class, 'showResetForm'])
    ->name('password.reset');

// Handle reset password request
Route::post('reset-password', [ResetPasswordController::class, 'reset'])
    ->name('password.update');


// -------------------- MANAGE USERS (Admin & SuperAdmin) --------------------

// Route::middleware(['auth', 'role:SuperAdmin'])->group(function () {

// });
// superadmin manage users
Route::prefix('dashboard/superadmin')
    ->name('superadmin.') // Prefix route names with "superadmin."
    ->middleware(['auth', 'role:SuperAdmin'])
    ->group(function () {
        Route::resource('users', ManageUserController::class);
        Route::resource('students', ManageStudentController::class);
        Route::resource('teachers', ManageTeacherController::class);
    });
    
// student dashboard routes
// Route::prefix('dashboard/student')
//     ->name('student.') // Prefix route names with "student."
//     ->middleware(['auth', 'role:Student'])
//     ->group(function () {
//         Route::get('/', [DashboardController::class, 'student'])->name('dashboard');

//         // Example resource routes (if needed)
//         Route::resource('profile', StudentProfileController::class);
//         Route::resource('attendance', StudentAttendanceController::class)->only(['index', 'show']);
//         Route::resource('grades', StudentGradeController::class)->only(['index', 'show']);
//     });
