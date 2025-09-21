<?php

use App\Http\Controllers\PrizeController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

//Route::get('/user', function (Request $request) {
//    return $request->user();
//})->middleware('auth:sanctum');

Route::post('/draw-lot', [PrizeController::class, 'drawLot']);
