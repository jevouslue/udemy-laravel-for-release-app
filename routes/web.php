<?php

use App\Http\Controllers\PrizeController;
use Illuminate\Support\Facades\Route;

Route::get('/home', [PrizeController::class, 'index'])->name('home');
