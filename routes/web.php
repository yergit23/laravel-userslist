<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Auth\RegisterController;
use App\Http\Controllers\Auth\LoginController;
use App\Http\Controllers\UserListController;
use App\Http\Controllers\UserCreateController;

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

Route::post('/login', [LoginController::class, 'store'])->middleware('guest');

Route::post('/logout', [LoginController::class, 'destroy'])->middleware('auth')->name('logout');

Route::get('/create',[UserCreateController::class, 'create'])->middleware(['auth', 'admin'])->name('users.create');

Route::get('/edit', function () {
    return view('edit');
});

Route::get('/umedia', function () {
    return view('media');
});

Route::get('/profile', function () {
    return view('page_profile');
})->middleware('auth')->name('profile');

Route::get('/register', [RegisterController::class, 'create'])->middleware('guest')->name('register');

Route::post('/register', [RegisterController::class, 'store'])->middleware('guest');

Route::get('/security', function () {
    return view('security');
});

Route::get('/status', function () {
    return view('status');
});

Route::get('/welcome', function () {
    return view('welcome');
})->name('welcome');
