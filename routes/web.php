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

Route::get('/', [UserListController::class, 'index'])->middleware('auth')->name('users.index');
Route::get('/welcome', [UserListController::class, 'welcome'])->middleware('auth');

Route::get('/login', [LoginController::class, 'create'])->middleware('guest')->name('login');
Route::post('/login', [LoginController::class, 'store'])->middleware('guest')->name('login.store');

Route::post('/logout', [LoginController::class, 'destroy'])->middleware('auth')->name('logout');

Route::get('/create', [UserCreateController::class, 'create'])->middleware(['auth', 'admin'])->name('users.create');
Route::post('/create', [UserCreateController::class, 'store'])->middleware(['auth', 'admin'])->name('users.store');

Route::get('/{id}-edit', [UserEditController::class, 'edit'])->middleware(['auth', 'selected.user', 'admin.author'])->name('users.edit');
Route::put('/{id}-edit', [UserEditController::class, 'update'])->middleware(['auth', 'selected.user', 'admin.author'])->name('users.update');

Route::get('/{id}-profile', [UserProfileController::class, 'show'])->middleware('auth', 'selected.user')->name('users.profile');

Route::get('/{id}-security', [UserSecurityController::class, 'edit'])->middleware(['auth', 'selected.user', 'admin.author'])->name('users.security');
Route::put('/{id}-security', [UserSecurityController::class, 'update'])->middleware(['auth', 'selected.user', 'admin.author'])->name('users.security.update');

Route::get('/{id}-status', [UserStatusController::class, 'edit'])->middleware(['auth', 'selected.user', 'admin.author'])->name('users.status');
Route::put('/{id}-status', [UserStatusController::class, 'update'])->middleware(['auth', 'selected.user', 'admin.author'])->name('users.status.update');

Route::get('/{id}-umedia', [UserMediaController::class, 'edit'])->middleware(['auth', 'selected.user', 'admin.author'])->name('users.media');
Route::put('/{id}-umedia', [UserMediaController::class, 'update'])->middleware(['auth', 'selected.user', 'admin.author'])->name('users.media.update');

Route::get('/register', [RegisterController::class, 'create'])->middleware('guest')->name('register');
Route::post('/register', [RegisterController::class, 'store'])->middleware('guest')->name('register.store');

Route::get('/{id}-delete', [UserDeleteController::class, 'getDestroy'])->middleware(['auth', 'selected.user', 'admin.author'])->name('users.get.destroy');
Route::delete('/{id}-delete', [UserDeleteController::class, 'destroy'])->middleware(['auth', 'selected.user', 'admin.author'])->name('users.destroy');
