<?php

use App\Http\Controllers\PrizeController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

//Route::get('/user', function (Request $request) {
//    return $request->user();
//})->middleware('auth:sanctum');

// 認証済みユーザでログイン時のみアクセス可能なルート
Route::middleware(['auth:sanctum', 'verified'])
    ->group(function () {
        Route::post('/draw-lot', [PrizeController::class, 'drawLot']);
    });
