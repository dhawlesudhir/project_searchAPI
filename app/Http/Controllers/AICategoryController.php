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
    public function comprehend(Request $request)
    {
        $category = new CategoryController();
        $categoriesData = $category->index($request, "data");
        //collection of resources related to category
        return view('layouts.main')->with('categories_resources', $categoriesData)->with('modal', __FUNCTION__);
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
}
