<?php

namespace App\Http\Controllers;

use App\customModules\Speech;
use Illuminate\Http\Request;



class SpeechController extends Controller
{
    public function speechToText()
    {
        $speech = new Speech();
        // $speech->speechToText1();
        // $speech->TextTospeech();
        echo __DIR__;die;
        $speech->speechToText();
    }

    public function textToSpeech(Request $request)
    {
        $text = $request->query('text');
        if ($text == '') {
            echo "no text received";
        } else {
            $speech = new Speech();
            $speech->TextTospeech($text);
        }
    }

    public function textExtract(){
        $speech = new Speech();
        $speech->textExtractfromImage();;
    }
}
