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
        echo __DIR__;
        die;
        $speech->speechToText();
    }


    public function textToSpeechAWS(String $str = '')
    {

        if (empty($str)) {
            return response()->json([
                'status' => 'failed',
                'msg' => " 'str' parameter is missing or empty",
            ], 400);
        }
        //URL
        $baseurl = 'https://it2c947od4.execute-api.us-east-1.amazonaws.com/prod/steve?';

        //parameters
        $user = 'user_id=mreader';
        $fixedparams = '&speaker=Amy&style=conversational&rate=100.0&bkmus=None&octave=0.0&startmusic=0&startvoice=5&relativevol=15&trailmusic=10';
        $variableparams = '&str=' . $str;
        $url = $baseurl . $user . $fixedparams . $variableparams;

        $curl = curl_init();

        curl_setopt_array($curl, array(
            CURLOPT_URL => $url,
            CURLOPT_RETURNTRANSFER => true,
            CURLOPT_ENCODING => '',
            CURLOPT_MAXREDIRS => 10,
            CURLOPT_TIMEOUT => 0,
            CURLOPT_FOLLOWLOCATION => true,
            CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
            CURLOPT_CUSTOMREQUEST => 'GET',
        ));

        $response = json_decode(curl_exec($curl));
        curl_close($curl);


        if ($response->statusCode == 200) {
            return response()->json([
                'status' => 'success',
                'msg' => " use URL for accessing Audio file",
                'str' => $str, 'url' => $response->url,
            ], 200);
        } else {
            return response()->json([
                'status' => 'failed',
                'msg' => " Something went wrong! " . $response->statusCode,
            ], 502);
        }
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

    public function textExtract()
    {
        $speech = new Speech();
        $speech->textExtractfromImage();;
    }
}
