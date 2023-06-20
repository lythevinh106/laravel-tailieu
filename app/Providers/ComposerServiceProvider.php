<?php

namespace App\Providers;

use App\Models\Category;
use App\Models\History;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\View;
use Illuminate\Support\ServiceProvider;

class ComposerServiceProvider extends ServiceProvider
{
    /**
     * Register services.
     *
     * @return void
     */
    public function register()
    {
        //
    }

    /**
     * Bootstrap services.
     *
     * @return void
     */
    public function boot()
    {
        View::composer('client.sidebar', function ($view) {
            $categories = Category::all();
            $view->with('categories_loading', $categories);
        });

        View::composer('client.sidebar', function ($view) {
            $id_auth = Auth::user()->id ?? 1;
            $histories = History::where("user_id", $id_auth)->get();
            $view->with('histories_loading', $histories);
        });
    }
}
