<?php

namespace App\Http\Controllers;

use Illuminate\Http\Client\Request as ClientRequest;
use Illuminate\Http\Request;

class AICategoryController extends Controller
{
    //
    public function texttospeech(Request $request)
    {
        return view('texttospeech');
    }
}
