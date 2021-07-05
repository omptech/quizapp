<?php

namespace App\Http\Controllers;

use App\Category;
use Illuminate\Http\Request;
use App\Http\Resources\Category\CategoryCollection;
use App\Http\Resources\Category\CategoryResource;
use Session;

class CategoryController extends Controller
{

    /**
     * Display a listing of featured categories.
     *
     * @return \Illuminate\Http\Response
     */
    public function featured()
    {
        return CategoryCollection::collection(Category::where('is_featured', 'yes')->get());
    }

    /**
     * Display a listing of all categories.
     *
     * @return \Illuminate\Http\Response
     */
    public function all()
    {
        return CategoryCollection::collection(Category::all());
    }

}
