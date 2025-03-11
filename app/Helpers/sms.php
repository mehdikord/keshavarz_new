<?php

function sms_kavenegar_pattern($phone,$template,$token,$token2=null,$token3=null){

    try{
        //Send null for tokens not defined in the template
        //Pass token10 and token20 as parameter 6th and 7th
        $kavenegar = new \Kavenegar\KavenegarApi(config('kavenegar.apikey'));
        $result = $kavenegar->VerifyLookup($phone, $token, $token2, $token3, $template);
        if($result){
            return true;
        }
    }
    catch(\Kavenegar\Exceptions\ApiException $e){
        // در صورتی که خروجی وب سرویس 200 نباشد این خطا رخ می دهد
        return $e->errorMessage();
    }
    catch(\Kavenegar\Exceptions\HttpException $e){
        // در زمانی که مشکلی در برقرای ارتباط با وب سرویس وجود داشته باشد این خطا رخ می دهد
        return $e->errorMessage();
    }


}
function sms_kavenegar_message($phone,$message){

    try{
        if (env('APP_ENV') !== 'local') {
            $kavenegar = new \Kavenegar\KavenegarApi(config('kavenegar.apikey'));
            $sender = "200030003040";		//This is the Sender number	//The body of SMS
            $receptor = array($phone);			//Receptors numbers

            $result = $kavenegar->Send($sender,$receptor,$message);
            if($result){
                return true;
            }
        }

    }
    catch(\Kavenegar\Exceptions\ApiException $e){
        // در صورتی که خروجی وب سرویس 200 نباشد این خطا رخ می دهد
        echo $e->errorMessage();
    }
    catch(\Kavenegar\Exceptions\HttpException $e){
        // در زمانی که مشکلی در برقرای ارتباط با وب سرویس وجود داشته باشد این خطا رخ می دهد
        return $e->errorMessage();
    }catch(\Exception $ex){
        // در صورت بروز خطایی دیگر
        return $ex->getMessage();
    }
}

function sms_meli_send($message,$phone)
{
    $message.="\n لغو۱۱";
    $url = 'https://console.melipayamak.com/api/send/advanced/00e8ca0836574062b2ddb748fae2f5c9';
    $data = array('from' => '50002710026950', 'to' => [$phone],
        'text' => $message, 'udh' => '');
    $data_string = json_encode($data);
    $ch = curl_init($url);
    curl_setopt($ch, CURLOPT_CUSTOMREQUEST, "POST");
    curl_setopt($ch, CURLOPT_POSTFIELDS, $data_string);

// Next line makes the request absolute insecure
    curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);
// Use it when you have trouble installing local issuer certificate
// See https://stackoverflow.com/a/31830614/1743997

    curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
    curl_setopt($ch, CURLOPT_HTTPHEADER,
        array('Content-Type: application/json',
            'Content-Length: ' . strlen($data_string))
    );
    $result = curl_exec($ch);
    curl_close($ch);
// to debug
// if(curl_errno($ch)){
//     echo 'Curl error: ' . curl_error($ch);
// }
}
function sms_generator($key,$data=[])
{
    $message='';
    $sms = \App\Models\Sms_Message::where('code',$key)->first();
    if ($sms){
        $message = $sms->message;
        foreach($data as $key => $val){
           $message = str_replace('$string'.$key+1,$val,$message);
        }
    }
    return $message;
}
