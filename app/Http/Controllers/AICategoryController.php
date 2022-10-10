<?php

namespace App\Http\Controllers;

use Illuminate\Http\Client\Request as ClientRequest;
use Illuminate\Http\Request;
use App\Models\Category;
use Illuminate\Support\Facades\Validator;


class AICategoryController extends Controller
{
    //
    public function texttospeech(Request $request)
    {
        // $category = new CategoryController();
        // $categoriesData = $category->index($request, "data");
        //collection of resources relate to category
        // return view('layouts.main')->with('categories_resources', $categoriesData)->with('modal', __FUNCTION__);
        return view('layouts.main')->with('modal', __FUNCTION__);
    }

    public function speechtotext(Request $request)
    {
        // $category = new CategoryController();
        // $categoriesData = $category->index($request, "data");
        //collection of resources related to category
        // return view('layouts.main')->with('categories_resources', $categoriesData)->with('modal', __FUNCTION__);
        return view('layouts.main')->with('modal', __FUNCTION__);
    }

    public function textextract(Request $request)
    {
        // $category = new CategoryController();
        // $categoriesData = $category->index($request, "data");
        //collection of resources related to category
        // return view('layouts.main')->with('categories_resources', $categoriesData)->with('modal', __FUNCTION__);
        return view('layouts.main')->with('modal', __FUNCTION__);
    }

    public function objectrecognisation(Request $request)
    {
        // $category = new CategoryController();
        // $categoriesData = $category->index($request, "data");
        //collection of resources related to category
        // return view('layouts.main')->with('categories_resources', $categoriesData)->with('modal', __FUNCTION__);
        return view('layouts.main')->with('modal', __FUNCTION__);
    }
    public function comprehend(Request $request)
    {
        // $category = new CategoryController();
        // $categoriesData = $category->index($request, "data");
        // //collection of resources related to category
        // return view('layouts.main')->with('categories_resources', $categoriesData)->with('modal', __FUNCTION__);
        return view('layouts.main')->with('modal', __FUNCTION__);
    }

    public function AWScomprehend(Request $request)
    {
        $text = $request->input('text');
        if (empty($text)) {
            return response()->json([
                'status' => 'failed',
                'msg' => " 'text' parameter is missing or empty",
            ], 400);
        }

        $curl = curl_init();

        curl_setopt_array($curl, array(
            CURLOPT_URL => 'https://l6evezpefe.execute-api.us-east-1.amazonaws.com/testing/comprehend/',
            CURLOPT_RETURNTRANSFER => true,
            CURLOPT_ENCODING => '',
            CURLOPT_MAXREDIRS => 10,
            CURLOPT_TIMEOUT => 0,
            CURLOPT_FOLLOWLOCATION => true,
            CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
            CURLOPT_CUSTOMREQUEST => 'POST',
            // CURLOPT_POSTFIELDS =>  $text,
            // CURLOPT_POSTFIELDS => '{
            //     "text":"Hello Zhang Wei, I am John. Your AnyCompany Financial Services, LLC credit card account 1111-0000-1111-0008 has a minimum payment of $24.53 that is due by July 31st. Based on your autopay settings, we will withdraw your payment on the due date from your bank account number XXXXXX1111 with the routing number XXXXX0000.Your latest statement was mailed to 2200 West Cypress Creek Road, 1st Floor, Fort Lauderdale, Florida, 33309. After your payment is received, you will receive a confirmation text message at 206-555-0100. If you have questions about your bill, AnyCompany Customer Service is available by phone at 206-555-0199 or email at support@anycompany.com."
            // }',
            CURLOPT_POSTFIELDS => '{
                "text": "' . $text . '"
            }',
        ));

        $response = curl_exec($curl);

        curl_close($curl);
        echo $response;
        die;


        return response()->json([
            'status' => 'success',
            'response' => $response
        ], 200);
    }

    public function AWSimagerecognization(Request $request)
    {

        if (!$request->hasFile('image')) {
            return response()->json([
                'status' => 'failed',
                'response' => "send or add 'image' data"
            ], 400);
        }

        $validator = Validator::make($request->all(), [
            'image' => 'mimes:png,jpeg',
        ]);

        if ($validator->fails()) {
            return response()->json([
                'status' => 'failed',
                'response' => "supported file format: JPEG or PNG"
            ], 415);
        }

        // Retrieve the validated input...
        $validated = $validator->validated();

        $file =  $validated['image'];

        $file = file_get_contents($file);

        if (!$file) {
            echo "file has no content";
        }
        // echo "file uploaded";
        // die;

        $curl = curl_init();

        curl_setopt_array($curl, array(
            CURLOPT_URL => 'https://u6r0dx9pzc.execute-api.us-east-1.amazonaws.com/v1/upload',
            CURLOPT_RETURNTRANSFER => true,
            CURLOPT_ENCODING => '',
            CURLOPT_MAXREDIRS => 10,
            CURLOPT_TIMEOUT => 0,
            CURLOPT_FOLLOWLOCATION => true,
            CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
            CURLOPT_CUSTOMREQUEST => 'POST',
            CURLOPT_POSTFIELDS => $file,
            CURLOPT_HTTPHEADER => array(
                'Content-Type: image/jpeg'
            ),
        ));

        $response = curl_exec($curl);

        curl_close($curl);

        if (!$response) {
            return response()->json([
                'status' => 'failed',
                'response' => 'failed to get response, try again'
            ], 500);
        }

        echo $response;
        die;

        return response()->json([
            'status' => 'success',
            'response' => $response
        ], 200);
    }


    public function textToSpeechAWS(Request $request)
    {

        $str = urlencode($request->input('str'));
        $speaker = $request->input('speaker');
        $languagecode = $request->input('languagecode');
        $engine = $request->input('engine');
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
        $fixedparams = '&speaker=' . $speaker . '&style=conversational&rate=100.0&bkmus=None&octave=0.0&startmusic=0&startvoice=5&relativevol=15&trailmusic=10';
        $variableparams = '&str=' . $str;
        $url = $baseurl . $user . $fixedparams . $variableparams;

        // $baseurl1 = 'https://cgw5jwfhhmfxhad7wnadjzmqum0mdpqb.lambda-url.us-east-1.on.aws/?';
        // //parameters1
        // $voice = $speaker;
        // $text = $str;
        // $languagecode = $languagecode;
        // $engine = $engine;

        // $parametersurl = 'voice=' . $speaker . '&text=' . $text . '&languagecode=' . $languagecode . '&engine=' . $engine;

        // $url = $baseurl1 . $parametersurl;
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
        // $response = curl_exec($curl);
        curl_close($curl);
        // return $response;
        // die;
        // if request failed
        if (!isset($response)) {
            return response()->json([
                'status' => 'failed',
                'msg' => " Something went wrong! ",
            ], 402);
        }

        if ($response->statusCode == 200) {
            return response()->json([
                'status' => 'success',
                'msg' => " use URL for accessing Audio file",
                'str' => $str,
                'url' => $response->url,
            ], 200);
        } else {
            return response()->json([
                'status' => 'failed',
                'msg' => " Something went wrong! ",
            ], 402);
        }
    }
}
