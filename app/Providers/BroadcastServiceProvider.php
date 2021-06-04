<?php

namespace App\Providers;

use Illuminate\Support\Facades\Broadcast;
use Illuminate\Support\ServiceProvider;

class BroadcastServiceProvider extends ServiceProvider
{
    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {
        Broadcast::routes();

        Broadcast::channel('App.Models.User.{id}', function ($user, $id) {
            return (int) $user->id === (int) $id;
        });

        // require base_path('routes/channels.php');
    }
}
