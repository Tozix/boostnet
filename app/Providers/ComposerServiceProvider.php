<?php

namespace BoostNet\Providers;

use Illuminate\Support\ServiceProvider;
use Illuminate\Support\Facades\View;
use BoostNet\Brand;
use BoostNet\Category;
use BoostNet\Basket;
class ComposerServiceProvider extends ServiceProvider
{
    /**
     * Register services.
     *
     * @return void
     */
    public function register() {
        // .....
    }

    /**
     * Bootstrap services.
     *
     * @return void
     */
    public function boot() {
        View::composer('catalog.part.roots', function($view) {
            $view->with(['items' => Category::roots()]);
        });
        View::composer('catalog.part.brands', function($view) {
            $view->with(['items' => Brand::popular()]);
        });
        View::composer('layouts.app', function($view) {
            $view->with(['positions' => Basket::getCount()]);
        });
        
    }

}

