<?php

namespace App\Http\Controllers;

use App\Models\resource;
use App\Http\Requests\StoreresourceRequest;
use Illuminate\Http\Request;

class ResourceController extends Controller
{

    public function texttospeech(Request $request)
    {
        $text = $request->str ? $request->str : '';
        $speech = new SpeechController();
        return $speech->textToSpeechAWS($text);
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
    }

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
     * @param  \App\Http\Requests\StoreresourceRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StoreresourceRequest $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\resource  $resource
     * @return \Illuminate\Http\Response
     */
    public function show(resource $resource)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\resource  $resource
     * @return \Illuminate\Http\Response
     */
    public function edit(resource $resource)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \App\Http\Requests\UpdateresourceRequest  $request
     * @param  \App\Models\resource  $resource
     * @return \Illuminate\Http\Response
     */
    public function update(UpdateresourceRequest $request, resource $resource)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\resource  $resource
     * @return \Illuminate\Http\Response
     */
    public function destroy(resource $resource)
    {
        //
    }
}
