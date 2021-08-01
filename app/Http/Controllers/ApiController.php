<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Str;
use App\Models\Subjects;
use App\Models\Tutor;
use Illuminate\Support\Facades\DB;

use function GuzzleHttp\json_decode;

class ApiController extends Controller
{
    public function sms_api()
    {
        //         $curl = curl_init();

        // $headers = ["Content-Type: application/json",
        // 	    "Accept: application/json",
        // 	    "Authorization: Bearer <6KxcN0Pcdnc8rFn0ghtfNVi8cSV1DslF>"];

        // $params = ['to' => '+9779841021302',"bypass_optout" => true,
        // 	    'message' => "This is test \n   This is a new line",
        // 	    //'callback_url' => "https://example.com/callback/handler",
        // 	    'sender_id' => 'SMSto'];

        // curl_setopt_array($curl, array(
        //   CURLOPT_URL => "https://api.sms.to/sms/send",
        //   CURLOPT_RETURNTRANSFER => true,
        //   CURLOPT_ENCODING => "",
        //   CURLOPT_MAXREDIRS => 10,
        //   CURLOPT_TIMEOUT => 0,
        //   CURLOPT_FOLLOWLOCATION => true,
        //   CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
        //   CURLOPT_CUSTOMREQUEST => "POST",
        //   CURLOPT_POSTFIELDS => json_encode($params),  
        //   CURLOPT_HTTPHEADER => $headers,
        // ));

        // $response = curl_exec($curl);
        // curl_close($curl);
        // echo $response;

        // OR
        // Using API Key via Query Param

        $curl = curl_init();

        curl_setopt_array($curl, array(
            CURLOPT_URL => "https://api.sms.to/sms/send?api_key=6KxcN0Pcdnc8rFn0ghtfNVi8cSV1DslF&bypass_optout=true&to=+9779843565197&message=Your OTP is 1234&sender_id=smsto",
            CURLOPT_RETURNTRANSFER => true,
            CURLOPT_ENCODING => "",
            CURLOPT_MAXREDIRS => 10,
            CURLOPT_TIMEOUT => 0,
            CURLOPT_FOLLOWLOCATION => true,
            CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
            CURLOPT_CUSTOMREQUEST => "GET",
        ));

        $response = curl_exec($curl);

        curl_close($curl);
        echo $response;
    }
}
