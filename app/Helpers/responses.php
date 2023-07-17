<?php
function response_custom_error($error): \Illuminate\Http\JsonResponse
{
    return response()->json(['error' => $error],409);
}
function response_success($result=[],$message=null): \Illuminate\Http\JsonResponse
{

    return response()->json(['result' => $result,'message' => $message]);
}
