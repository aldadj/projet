<?php

namespace App\Providers;
use Illuminate\Support\ServiceProvider;
use Illuminate\Support\Facades\View; // Import important
use App\Models\Category; // Import de ton modèle

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
        // On partage la variable $categories avec TOUTES les vues du site
        View::composer('*', function ($view) {
            $view->with('categories', Category::all());
        });
    }
}