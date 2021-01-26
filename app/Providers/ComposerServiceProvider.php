<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use Illuminate\Support\Facades\View;
use App\Models\Brand;
use App\Models\Category;
use App\Models\Basket;
use App\Models\Page;


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
        View::composer('layouts.part.pages', function ($view) {
            $view->with(['pages' => Page::all()]);
        });
    }
}
