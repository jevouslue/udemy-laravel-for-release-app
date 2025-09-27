<?php

namespace App\Providers;

use App\Mail\VerifyEmailMail;
use App\Models\User;
use Illuminate\Auth\Notifications\VerifyEmail;
use Illuminate\Cache\RateLimiting\Limit;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\RateLimiter;
use Illuminate\Support\ServiceProvider;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     */
    public function register(): void
    {
        //
    }

    /**
     * Bootstrap any application services.
     */
    public function boot(): void
    {
        RateLimiter::for('login', function (Request $request) {
            return Limit::perMinute(2)->by($request->get('email').'|'.$request->ip());
        });

        VerifyEmail::toMailUsing(function (User $user, string $url) {
            return (new VerifyEmailMail($url))->to($user->email);
        });
    }
}
