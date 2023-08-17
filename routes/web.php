<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Auth\RegisterController;
use App\Http\Controllers\Auth\LoginController;
use App\Http\Controllers\UserListController;
use App\Http\Controllers\UserCreateController;
use App\Http\Controllers\UserEditController;
use App\Http\Controllers\UserProfileController;
use App\Http\Controllers\UserSecurityController;
use App\Http\Controllers\UserStatusController;
use App\Http\Controllers\UserMediaController;
use App\Http\Controllers\UserDeleteController;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::middleware('guest')->group(function () {
    Route::get('/login', [LoginController::class, 'create'])->name('login');
    Route::post('/login', [LoginController::class, 'store'])->name('login.store');

    Route::get('/register', [RegisterController::class, 'create'])->name('register');
    Route::post('/register', [RegisterController::class, 'store'])->name('register.store');
});

Route::middleware('auth')->group(function () {
    Route::get('/', [UserListController::class, 'index'])->name('users.index');
    Route::get('/search', [UserListController::class, 'search'])->name('users.search');

    Route::get('/welcome', [UserListController::class, 'welcome']);

    Route::get('/logout', [LoginController::class, 'getDestroy'])->name('logout.get.destroy');
    Route::post('/logout', [LoginController::class, 'destroy'])->name('logout.destroy');
});

Route::middleware(['auth', 'selected.user'])->group(function () {
    Route::get('/{id}-profile', [UserProfileController::class, 'show'])->name('users.profile');
});

Route::middleware(['auth', 'admin'])->group(function () {
    Route::get('/create', [UserCreateController::class, 'create'])->name('users.create');
    Route::post('/create', [UserCreateController::class, 'store'])->name('users.store');
});

Route::middleware(['auth', 'selected.user', 'admin.author'])->group(function () {
    Route::get('/{id}-edit', [UserEditController::class, 'edit'])->name('users.edit');
    Route::put('/{id}-edit', [UserEditController::class, 'update'])->name('users.update');

    Route::get('/{id}-security', [UserSecurityController::class, 'edit'])->name('users.security');
    Route::put('/{id}-security', [UserSecurityController::class, 'update'])->name('users.security.update');

    Route::get('/{id}-status', [UserStatusController::class, 'edit'])->name('users.status');
    Route::put('/{id}-status', [UserStatusController::class, 'update'])->name('users.status.update');

    Route::get('/{id}-umedia', [UserMediaController::class, 'edit'])->name('users.media');
    Route::put('/{id}-umedia', [UserMediaController::class, 'update'])->name('users.media.update');

    Route::get('/{id}-delete', [UserDeleteController::class, 'getDestroy'])->name('users.get.destroy');
    Route::delete('/{id}-delete', [UserDeleteController::class, 'destroy'])->name('users.destroy');
});
