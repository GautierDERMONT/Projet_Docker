<?php

use App\Http\Controllers\ConcoursController;
use App\Http\Controllers\AuthController;
use Illuminate\Support\Facades\Route;

Route::get('/', [ConcoursController::class,'index'])->name('home');
//Route::get('/concours/epreuves/{id}', [ConcoursController::class,'allEpreuves'])->name('showEpreuves')->whereNumber('id');
//Route::get('/concours/{id}/epreuves', [ConcoursController::class, 'allEpreuves'])->name('showEpreuves')->whereNumber('id');
//Route::get('/epreuve/{id}/couples', [ConcoursController::class, 'getCouples'])->name('getCouples')->whereNumber('id');
Route::get('/concours/couples/{idConcours}/{numListeEpreuve}', [ConcoursController::class,'listing'])->name('listing')->whereNumber('idConcours')->whereNumber('numListeEpreuve');

Route::get('/login', [AuthController::class, 'loginFormulaire'])->name('loginFormulaire');
Route::post('/login', [AuthController::class, 'login'])->name('login');

Route::get('/logout', [AuthController::class, 'logout'])->name('logout');