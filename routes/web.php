<?php

use App\Http\Controllers\ConcoursController;
use Illuminate\Support\Facades\Route;

Route::get('/', [ConcoursController::class,'index'])->name('home');
Route::get('/concours/epreuves/{id}', [ConcoursController::class,'index'])->name('epreuves')->whereNumber('id');
