<?php

use App\Http\Controllers\AuthController;
use App\Http\Controllers\PasswordResetLinkController;
use App\Http\Controllers\UpdateEmailController;
use App\Http\Controllers\VerifyEmailController;
use App\Http\Controllers\PrizeController;
use App\Http\Controllers\UserController;
use Illuminate\Support\Facades\Route;


// ログイン時のみアクセス可能なルート
Route::middleware(['auth', 'auth.session'])
    ->group(function () {
        // ログアウト
        Route::post('/logout', [AuthController::class, 'logout'])->name('logout');

        // プロフィール編集ページ
        Route::get('/account', [UserController::class, 'edit'])->name('account.edit');
        Route::post('/account', [UserController::class, 'update'])->name('account.update');

        // 仮登録完了画面
        Route::get('/email/verify', [VerifyEmailController::class, 'showVerifyForm'])->name('verification.notice');

        // 確認リンクを再送信用
        Route::post('/email/verification-notification', [VerifyEmailController::class, 'verificationNotification'])
            ->middleware('throttle:6,1')
            ->name('verification.send');

        // メールアドレス確認リンク用
        Route::get('/email/verify/{id}/{hash}', [VerifyEmailController::class, 'verify'])
            ->middleware('signed')
            ->name('verification.verify');

        // メールアドレスの変更フォーム
        Route::get('/email/edit', [UpdateEmailController::class, 'edit'])->name('email.edit');

        // メールアドレス変更処理
        Route::post('/email/update', [UpdateEmailController::class, 'update'])->name('email.update');
    });


// 認証済みユーザでログイン時のみアクセス可能なルート
Route::middleware(['auth', 'auth.session', 'verified'])
    ->group(function () {
        // 抽選ページ
        Route::get('/home', [PrizeController::class, 'index'])->name('home');
    });


// 未ログイン時のみアクセス可能なルート
Route::middleware('guest')
    ->group(function () {
        // ログイン
        Route::get('/login', [AuthController::class, 'showLoginForm'])->name('login');
        Route::post('/login', [AuthController::class, 'login'])->middleware('throttle:login');
        // ユーザ登録
        Route::resource('/account', UserController::class)->only(['create', 'store']);

        Route::get('/reset-password', [PasswordResetLinkController::class, 'showRequestForm'])
            ->name('password.request');

        Route::post('/reset-password', [PasswordResetLinkController::class, 'sendResetMail'])
            ->name('password.email');

        Route::get('/reset-password/{token}', [PasswordResetLinkController::class, 'showResetForm'])
            ->name('password.reset');

        Route::patch('/reset-password/', [PasswordResetLinkController::class, 'resetPassword'])
            ->name('password.store');
    });
