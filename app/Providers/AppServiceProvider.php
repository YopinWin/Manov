<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use Illuminate\Support\Facades\View;
use Illuminate\Support\Facades\DB;

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
        View::composer('*', function ($view) {

            if (auth()->check()) {

                $userId = auth()->id();

                $avg = DB::table('user_progress')
                    ->where('user_id', $userId)
                    ->avg('nilai');

                if (!$avg) $tanaman = "🌰";
                elseif ($avg < 40) $tanaman = "🌰";
                elseif ($avg < 60) $tanaman = "🌱";
                elseif ($avg < 75) $tanaman = "🌿";
                elseif ($avg < 90) $tanaman = "🌳";
                else $tanaman = "🌳✨";

                $view->with('tanaman', $tanaman);
            }

        });
    }
}