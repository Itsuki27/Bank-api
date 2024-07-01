<?php

namespace App\Http\Controllers;

abstract class Controller
{
    protected function BadRequest($validator){
        return response()->json(['ok' => false, 'errors' => $validator->errors()]);
    }

    protected function Ok($data = null, $message = "OK", $others = []){
        return response()->json(['ok' => true, 'data' => $data, 'message' => $message, 'others' => $others], 200);
    }

    protected function NoDataFound(){
        return response()->json(['ok' => false, 'message' => 'No data found.']);
    }

    protected function Specific($message ="Specific Error."){
        return response()->json(['ok'=>false, 'message' => $message]);
    }

    protected function Unauthorized($message = "Unauthorized!"){
        return response()->json(['ok' => false, 'message' => $message]);
    }
}
