<?php

namespace BoostNet\Providers;

use Illuminate\Support\ServiceProvider;
use Illuminate\Support\Facades\View;
use BoostNet\Models\Brand;
use BoostNet\Models\Category;
use BoostNet\Models\Basket;

class ComposerServiceProvider extends ServiceProvider
{
    /**
     * Register services.
     *
     * @return void
     */
    public function register()
    {
        // .....
    }

    /**
     * Bootstrap services.
     *
     * @return void
     */
    public function boot()
    {
        View::composer('layouts.part.roots', function ($view) {
            $view->with(['items' => Category::all()]);
        });
        View::composer('layouts.part.brands', function ($view) {
            $view->with(['items' => Brand::popular()]);
        });
        View::composer('layouts.app', function ($view) {
            $view->with(['positions' => Basket::getCount()]);
        });
    }
}
