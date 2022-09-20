<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Http\Requests\StorecategoryRequest;
use App\Http\Requests\UpdatecategoryRequest;
use App\Models\resource;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;


class CategoryController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */

    //  index with db data
    // public function index(Request $request, String $type = 'default')
    // {
    //     $search = $request->query('search');
    //     if ($search) {
    //         // $resourcedata = resource::select('id')
    //         //     // ->where('status', 1)
    //         //     ->where('name', 'like', '%' . $search . '%')
    //         //     ->get();
    //         $resourcedata = DB::table('resources')
    //             // ->where('status', 1)
    //             ->where('name', 'like', '%' . $search . '%')
    //             ->get('id');

    //         // dd($resourcedata->pluck('id'));

    //         // $categoryids = DB::table('category_resource')
    //         //     ->select('category_id')
    //         //     ->whereIn('resource_id', $resourcedata)
    //         //     ->get();
    //         if (isset($resourcedata)) {
    //             $categoryids = DB::table('category_resource')
    //                 ->whereIn('resource_id', $resourcedata->pluck('id'))
    //                 ->get('category_id');
    //         }
    //         // dd($categoryids);




    //         if (isset($categoryids)) {
    //             $categoryids =  $categoryids->pluck('category_id');
    //             $categoriesData = category::where('status', 1)
    //                 // ->where('name', 'like', '%' . $search . '%')
    //                 ->whereIn('id', $categoryids)
    //                 ->get();
    //         } else {
    //             $categoriesData = category::where('status', 1)->get();
    //         }
    //     } else {
    //         $categoriesData = category::where('status', 1)->get();
    //     }

    //     if ($type == 'default') {
    //         return view('layouts.main')->with('categories_resources', $categoriesData);
    //     } else {
    //         return $categoriesData;
    //     }
    // }

    public function index()
    {

        return view('layouts.main');
    }
    /*
    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \App\Http\Requests\StorecategoryRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StorecategoryRequest $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\category  $category
     * @return \Illuminate\Http\Response
     */
    public function show(category $category)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\category  $category
     * @return \Illuminate\Http\Response
     */
    public function edit(category $category)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \App\Http\Requests\UpdatecategoryRequest  $request
     * @param  \App\Models\category  $category
     * @return \Illuminate\Http\Response
     */
    public function update(UpdatecategoryRequest $request, category $category)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\category  $category
     * @return \Illuminate\Http\Response
     */
    public function destroy(category $category)
    {
        //
    }
}
