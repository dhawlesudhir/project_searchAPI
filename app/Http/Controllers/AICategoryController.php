<?php

namespace App\Http\Controllers;

use Illuminate\Http\Client\Request as ClientRequest;
use Illuminate\Http\Request;
use App\Models\Category;

class AICategoryController extends Controller
{
    //
    public function texttospeech(Request $request)
    {
        $category = new CategoryController();
        $categoriesData = $category->index($request, "data");
        //collection of resources relate to category 
        return view('layouts.main')->with('categories_resources', $categoriesData)->with('modal', __FUNCTION__);
    }

    public function speechtotext(Request $request)
    {
        $category = new CategoryController();
        $categoriesData = $category->index($request, "data");
        //collection of resources related to category 
        return view('layouts.main')->with('categories_resources', $categoriesData)->with('modal', __FUNCTION__);
    }

    public function textextract(Request $request)
    {
        $category = new CategoryController();
        $categoriesData = $category->index($request, "data");
        //collection of resources related to category 
        return view('layouts.main')->with('categories_resources', $categoriesData)->with('modal', __FUNCTION__);
    }

    public function objectrecognisation(Request $request)
    {
        $category = new CategoryController();
        $categoriesData = $category->index($request, "data");
        //collection of resources related to category 
        return view('layouts.main')->with('categories_resources', $categoriesData)->with('modal', __FUNCTION__);
    }
}
