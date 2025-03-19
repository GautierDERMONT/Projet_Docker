<?php

use App\Http\Controllers\ConcoursController;
use Illuminate\Support\Facades\Route;

Route::get('/', [ConcoursController::class,'index'])->name('home');
Route::get('/concours/epreuves/{id}', [ConcoursController::class,'allEpreuves'])->name('showEpreuves')->whereNumber('id');
Route::get('/concours/epreuves/couples/{id}', [ConcoursController::class,'allCouples'])->name('showCouples')->whereNumber('id');
