<?php

use App\Http\Controllers\Agenda;
use App\Http\Controllers\Auth\Login;
use App\Http\Controllers\Auth\Logout;
use App\Http\Controllers\Auth\Password;
use App\Http\Controllers\Bidang;
use App\Http\Controllers\Dashboard;
use App\Http\Controllers\Kalender;
use App\Http\Controllers\Users;
use Illuminate\Support\Facades\Route;



Route::get('/kalender', Kalender::class)->name('kalender');
Route::group(['middleware' => 'auth'], function () {
    Route::get('/', Dashboard::class)->name('/');
    Route::group(['middleware' => ['role:user|admin']], function () {
        Route::get('agenda', Agenda::class)->name('agenda');
        Route::get('bidang', Bidang::class)->name('bidang');
    });
    Route::group(['middleware' => ['role:admin']], function () {
        Route::get('users', Users::class)->name('users');
    });
    Route::get('password', Password::class)->name('password');
    Route::get('logout', Logout::class)->name('logout');
});
Route::group(['middleware' => 'NoAuth'], function () {
    Route::get('login', Login::class)->name('login');
});
