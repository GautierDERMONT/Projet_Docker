<?php

use App\Http\Controllers\ConcoursController;
use App\Http\Controllers\AuthController;
use Illuminate\Support\Facades\Route;

Route::get('/', [ConcoursController::class,'index'])->name('home');
Route::get('/concours/epreuves/{id}', [ConcoursController::class,'allEpreuves'])->name('showEpreuves')->whereNumber('id');
//Route::get('/epreuve/{id}/couples', [ConcoursController::class, 'getCouples'])->name('getCouples')->whereNumber('id');
Route::get('/concours/couples/{idConcours}/{numListeEpreuve}', [ConcoursController::class,'listing'])->name('listing')->whereNumber('idConcours')->whereNumber('numListeEpreuve');

Route::get('/login', [AuthController::class, 'loginFormulaire'])->name('loginFormulaire');
Route::post('/login', [AuthController::class, 'login'])->name('login');
Route::get('/logout', [AuthController::class, 'logout'])->name('logout');

Route::get('/concours/couples/commencerEpreuve/{idEpreuve}', [ConcoursController::class, 'commencerEpreuve'])->name('commencerEpreuve')->whereNumber('idEpreuve');
Route::get('/concours/couples/terminerEpreuve/{idEpreuve}', [ConcoursController::class, 'terminerEpreuve'])->name('terminerEpreuve')->whereNumber('idEpreuve');
Route::get('/concours/couples/cloturerEpreuve/{idEpreuve}', [ConcoursController::class, 'cloturerEpreuve'])->name('cloturerEpreuve')->whereNumber('idEpreuve');

Route::get('/concours/couples/notifierBordPiste/{idCouple}', [ConcoursController::class, 'notifierBordPiste'])->name('notifierBordPiste')->whereNumber('idCouple');
Route::get('/concours/couples/notifierEnPiste/{idCouple}', [ConcoursController::class, 'notifierEnPiste'])->name('notifierEnPiste')->whereNumber('idCouple');
Route::get('/concours/couples/notifierNonPartant/{idCouple}', [ConcoursController::class, 'notifierNonPartant'])->name('notifierNonPartant')->whereNumber('idCouple');
Route::get('/concours/couples/notifierElimine/{idCouple}', [ConcoursController::class, 'notifierElimine'])->name('notifierElimine')->whereNumber('idCouple');
Route::post('/concours/couples/notifierFini/{idCouple}', [ConcoursController::class, 'notifierFini'])->name('notifierFini')->whereNumber('idCouple');
Route::get('/concours/couples/modifierCouple/{idCouple}', [ConcoursController::class, 'modifierCouple'])->name('modifierCouple')->whereNumber('idCouple');
Route::post('/concours/couples/modifierCouple/{idCouple}', [ConcoursController::class, 'modifierCoupleSave'])->name('modifierCoupleSave')->whereNumber('idCouple');
