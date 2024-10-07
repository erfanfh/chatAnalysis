<?php

use App\Http\Controllers\ChatController;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('home');
});

Route::post('check', [ChatController::class, 'check'])->name('check');
Route::get('check', [ChatController::class, 'check'])->name('check');
