<?php

use App\Http\Controllers\VideoController;
use App\Http\Controllers\Testtt;
use Illuminate\Support\Facades\Route;

Route::get('/', [VideoController::class, 'index'])->name('videos.index');
Route::post('/videos', [VideoController::class, 'store'])->name('videos.store');
Route::get('/videos/{id}', [VideoController::class, 'show'])->name('videos.show');
Route::put('/videos/{id}', [VideoController::class, 'update'])->name('videos.update');
Route::delete('/videos/{id}', [VideoController::class, 'destroy'])->name('videos.destroy');

