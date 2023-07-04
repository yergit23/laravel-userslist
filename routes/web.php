<?php

use Illuminate\Support\Facades\Route;

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

Route::get('/', function () {
    return view('users');
});

Route::get('/login', function () {
    return view('page_login');
});

Route::get('/create', function () {
    return view('create_user');
});

Route::get('/edit', function () {
    return view('edit');
});

Route::get('/umedia', function () {
    return view('media');
});

Route::get('/profile', function () {
    return view('page_profile');
});

Route::get('/register', function () {
    return view('page_register');
});

Route::get('/security', function () {
    return view('security');
});

Route::get('/status', function () {
    return view('status');
});

Route::get('/welcome', function () {
    return view('welcome');
});
