<?php

namespace App\Providers;

use Illuminate\Support\Facades\View;
use Illuminate\Support\ServiceProvider;
use App\Services\MenuService;

class MenuServiceProvider extends ServiceProvider
{
    /**
     * Register services.
     *
     * @return void
     */
    public function register()
    {
        $this->app->bind('MenuService', function () {
            return new MenuService();
        });
    }

    /**
     * Bootstrap services.
     *
     * @return void
     */
    public function boot()
    {
        View::composer('layouts.main', function ($view) {
            $groupId = session('group_id'); // Ambil nilai group_id dari session

            $menuService = app('MenuService');
            $menuHeaders = $menuService->getMenuHeaders($groupId);
            $view->with('menuHeaders', $menuHeaders);
        });
    }
}
