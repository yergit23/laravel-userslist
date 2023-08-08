<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Auth\RegisterController;
use App\Http\Controllers\Auth\LoginController;
use App\Http\Controllers\UserListController;
use App\Http\Controllers\UserCreateController;
use App\Http\Controllers\UserEditController;
use App\Http\Controllers\UserProfileController;
use App\Http\Controllers\UserSecurityController;

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

Route::get('/login', [LoginController::class, 'create'])->middleware('guest')->name('login');
Route::post('/login', [LoginController::class, 'store'])->middleware('guest')->name('login.store');

Route::post('/logout', [LoginController::class, 'destroy'])->middleware('auth')->name('logout');

Route::get('/create', [UserCreateController::class, 'create'])->middleware(['auth', 'admin'])->name('users.create');
Route::post('/create', [UserCreateController::class, 'store'])->middleware(['auth', 'admin'])->name('users.store');

Route::get('/{id}-edit', [UserEditController::class, 'edit'])->middleware(['auth', 'selected.user', 'admin.author'])->name('users.edit');
Route::put('/{id}-edit', [UserEditController::class, 'update'])->middleware(['auth', 'selected.user', 'admin.author'])->name('users.update');

Route::get('/{id}-profile', [UserProfileController::class, 'show'])->middleware('auth', 'selected.user')->name('users.profile');

Route::get('/{id}-security', [UserSecurityController::class, 'show'])->middleware(['auth', 'selected.user', 'admin.author'])->name('users.security');
Route::put('/{id}-security', [UserSecurityController::class, 'update'])->middleware(['auth', 'selected.user', 'admin.author'])->name('users.security.update');

Route::get('/status', function () {
    return view('status');
});

Route::get('/umedia', function () {
    return view('media');
});

Route::get('/register', [RegisterController::class, 'create'])->middleware('guest')->name('register');

Route::post('/register', [RegisterController::class, 'store'])->middleware('guest');

Route::get('/welcome', function () {
    return view('welcome');
})->name('welcome');
