<?php

namespace App\Http\Controllers;

use App\customModules\Speech;



class SpeechController extends Controller
{
    public function speechToText(){
        $speech = new Speech();
        $speech->speechToText();
        // $speech->TextTospeech();
        // $speech->speechToText1();
    }

    public function textToSpeech(){
        $speech = new Speech();
        $speech->TextTospeech();
    }
}
