<?php

namespace App\Providers;

use App\Models\Actor;
use App\Models\Category;
use Illuminate\Support\ServiceProvider;
use Illuminate\Support\Facades\View;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     */
    public function register(): void
    {
        $this->app->bind(
            'App\Repositories\PhotosRepositoryInterface',
            'App\Repositories\PhotosRepository'
        );
    }

    /**
     * Bootstrap any application services.
     */
    public function boot(): void
    {
        View::composer(['index', 'create', 'edit'], function ($view) {
            $view->with('categories', Category::all());
            $view->with('actors', Actor::all());
        });

    }
}
