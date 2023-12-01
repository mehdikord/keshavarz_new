<?php
function response_custom_error($error): \Illuminate\Http\JsonResponse
{
    return response()->json(['error' => $error],409);
}
function response_success($result=[],$message=null,$code=200): \Illuminate\Http\JsonResponse
{

    return response()->json(['result' => $result,'message' => $message],$code);
}

function response_unauthorized(): \Illuminate\Http\JsonResponse
{
    return response()->json('Unauthorized',401);
}
