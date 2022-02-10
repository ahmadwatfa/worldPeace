<?php

namespace App\Http\Controllers\Api;


use Illuminate\Http\Request;

use App\Http\Controllers\Controller as Controller;



class BaseController extends Controller

{


    public function sendResponse( $message ,$result)

    {

        $response = [

            'status' => true,
            'statusCode'=>200,
            'message' => $message,
            'item'    => $result,

        ];



        return response()->json($response);

    }


    public function sendError($statusCode, $errorMessages)

    {

        $response = [

            'status' => false,
            'statusCode'=>$statusCode,
            'message' => $errorMessages,
            'item'    => [],
        ];

        // if(!empty($errorMessages)){

        //     $response['data'] = $errorMessages;

        // }
        return response()->json($response);

    }

}
