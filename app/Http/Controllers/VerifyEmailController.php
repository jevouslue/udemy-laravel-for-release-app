<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Auth\Events\Verified;
use Illuminate\Foundation\Auth\EmailVerificationRequest;
use Illuminate\Http\Request;

class VerifyEmailController extends Controller
{
    public function showVerifyForm(Request $request)
    {
        return view('auth.verify-email');

//        return $request->user()->hasVerifiedEmail()
//            ? redirect()->intended(route('home', absolute: false))
//            : view('auth.verify-email');
    }

    public function verificationNotification(Request $request)
    {
//        if ($request->user()->hasVerifiedEmail()) {
//            return redirect()->intended(route('home', absolute: false));
//        }
        $request->user()->sendEmailVerificationNotification();
        return back()->with('message', __('Verification link sent!'));
    }

    public function verify(EmailVerificationRequest $request) {
        $user = $request->user();
        if($user->hasVerifiedEmail()){
            // メールアドレス再設定時の認証
            if(User::where('email', $user->newMailAddress->email)->exists()){
                return to_route('email.edit')->with('error', '既に使用されているメールアドレスです');
            }
            $user->update(['email' => $user->newMailAddress->email]);
            return to_route('email.edit')->with('success', 'メールアドレスを変更しました');
        }

        // 新規の時の認証
        $request->fulfill();
        return to_route('home')->with('message', 'メールアドレスを確認しました');

//        if ($request->user()->hasVerifiedEmail()) {
//            return redirect()->intended(route('home', absolute: false));
//        }
//
//        if ($request->user()->markEmailAsVerified()) {
//            event(new Verified($request->user()));
//        }
//        return redirect()->intended(route('home', absolute: false));
    }
}
