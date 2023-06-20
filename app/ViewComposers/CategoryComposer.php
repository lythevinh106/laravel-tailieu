<?php

namespace App\Http\ViewComposers;

use App\Models\Category;
use Illuminate\View\View;

class CategoryComposer
{
    public $movieList = [];
    /**
     * Create a movie composer.
     *
     * @return void
     */
    public function __construct()
    {
    }

    /**
     * Bind data to the view.
     *
     * @param  View  $view
     * @return void
     */
    public function compose(View $view)
    {

        $load_categories = Category::where("active", 1)->get();
        $view->with('categories_loading', end($load_categories));
    }
}
