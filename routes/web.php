<?php

use App\Http\Controllers\ConcoursController;
use App\Http\Controllers\AuthController;
use Illuminate\Support\Facades\Route;

Route::get('/', [ConcoursController::class,'index'])->name('home');
Route::get('/concours/epreuves/{id}', [ConcoursController::class,'allEpreuves'])->name('showEpreuves')->whereNumber('id');
Route::get('/concours/epreuves/couples/{id}', [ConcoursController::class,'allCouples'])->name('showCouples')->whereNumber('id');

Route::get('/login', [AuthController::class, 'loginFormulaire'])->name('loginFormulaire');
Route::post('/login', [AuthController::class, 'login'])->name('login');

Route::get('/logout', [AuthController::class, 'logout'])->name('logout');