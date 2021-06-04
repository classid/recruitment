<?php

namespace App\Http\Routes;

use Dentro\Yalr\BaseRoute;
use Illuminate\Cache\RateLimiting\Limit;
use Illuminate\Foundation\Application;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\RateLimiter;
use Illuminate\Support\Facades\Route;
use Inertia\Inertia;

class DefaultRoute extends BaseRoute
{
    /**
     * Register routes handled by this class.
     *
     * @return void
     */
    public function register(): void
    {
        $this->registerRateLimiter();
        $this->registerBindingRoute();

        $this->router->get('/', [
            'as' => $this->name('default'),
            'uses' => fn () => Inertia::render('Welcome', [
                'canLogin' => Route::has('login'),
                'canRegister' => Route::has('register'),
                'laravelVersion' => Application::VERSION,
                'phpVersion' => PHP_VERSION,
            ])
        ]);
    }

    private function registerRateLimiter(): void
    {
        RateLimiter::for('api', function (Request $request) {
            return Limit::perMinute(60)->by(optional($request->user())->id ?: $request->ip());
        });
    }

    private function registerBindingRoute(): void
    {
        //
    }
}
