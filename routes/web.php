<?php

use Illuminate\Support\Facades\Route;
// routes/web.php
use App\Http\Controllers\AuthController;


Route::get('/', function () {
    $featuredCats = \App\Models\Cat::where('status', \App\Enums\CatStatus::AVAILABLE->value)
                        ->latest()
                        ->take(3)
                        ->get();
    return view('welcome', compact('featuredCats'));
});

Route::get('/login', [AuthController::class, 'index'])->name('login')->middleware('guest');
Route::post('/login', [AuthController::class, 'login']);

Route::get('/register', [AuthController::class, 'showRegister'])->name('register')->middleware('guest');
Route::post('/register', [AuthController::class, 'register']);
Route::post('/logout', [AuthController::class, 'logout'])->name('logout');

use App\Http\Controllers\Admin\CatController;
use App\Http\Controllers\User\CatalogController;
use App\Http\Controllers\User\AdoptionController as UserAdoptionController;
use App\Http\Controllers\User\DashboardController as UserDashboardController;
use App\Http\Controllers\User\ProfileController as UserProfileController;
use App\Http\Controllers\Admin\AdoptionController as AdminAdoptionController;

use App\Http\Controllers\Admin\DashboardController;
use App\Http\Controllers\Admin\VerificationController;
use App\Http\Controllers\Admin\UserController as AdminUserController;

Route::middleware(['auth', 'admin'])->group(function () {
    Route::get('admin/dashboard', [DashboardController::class, 'index'])->name('admin.dashboard');
    Route::get('admin/report/pdf', [DashboardController::class, 'downloadReport'])->name('admin.report.pdf');

    Route::get('admin/verify', [VerificationController::class, 'index'])->name('admin.verify.index');
    Route::post('admin/verify', [VerificationController::class, 'verify'])->name('admin.verify.submit');

    Route::resource('admin/cats', CatController::class)->names('admin.cats');
    
    Route::get('admin/adoptions', [AdminAdoptionController::class, 'index'])->name('admin.adoptions.index');
    Route::post('admin/adoptions/{adoption}/approve', [AdminAdoptionController::class, 'approve'])->name('admin.adoptions.approve');
    Route::post('admin/adoptions/{adoption}/reject', [AdminAdoptionController::class, 'reject'])->name('admin.adoptions.reject');

    Route::get('admin/users', [AdminUserController::class, 'index'])->name('admin.users.index');
    Route::delete('admin/users/{user}', [AdminUserController::class, 'destroy'])->name('admin.users.destroy');
});

Route::middleware(['auth'])->group(function () {
    Route::get('/dashboard', [UserDashboardController::class, 'index'])->name('user.dashboard');
    
    Route::get('/profile', [UserProfileController::class, 'edit'])->name('user.profile.edit');
    Route::put('/profile', [UserProfileController::class, 'update'])->name('user.profile.update');

    Route::get('/adoptions', [UserAdoptionController::class, 'index'])->name('user.adoptions.index');
    Route::post('/adoptions', [UserAdoptionController::class, 'store'])->name('user.adoptions.store');
    Route::get('/adoptions/{adoption}/proof', [UserAdoptionController::class, 'downloadProof'])->name('user.adoptions.proof');
});

Route::get('/catalog', [CatalogController::class, 'index']);