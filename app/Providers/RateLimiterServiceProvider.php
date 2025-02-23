<?php

namespace App\Providers;


use Illuminate\Http\Request;
use Illuminate\Support\Facades\RateLimiter;
use Illuminate\Support\ServiceProvider;
use Illuminate\Cache\RateLimiting\Limit;
class RateLimiterServiceProvider extends ServiceProvider
{
    /**
     * Register services.
     */
    public function register(): void
    {
        //
    }

    /**
     * Bootstrap services.
     */
    public function boot(): void
    {
        RateLimiter::for('api', function (Request $request) {
            return Limit::perMinute(60)->by(optional($request->user())->id ?: $request->ip());
        });

        RateLimiter::for('customer-login-register-limiter', function (Request $request) {
            return Limit::perMinute(5)->by($request->ip());
        });

        RateLimiter::for('customer-login-confirm-limiter', function (Request $request) {
            return Limit::perMinute(5)->by(url()->current() . $request->ip());
        });

        RateLimiter::for('customer-login-resend-otp-limiter', function (Request $request) {
            return Limit::perMinute(5)->by(url()->current() . $request->ip());
        });
    }
}
