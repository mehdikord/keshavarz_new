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



//    try{
//        $kavenegar = new \Kavenegar\KavenegarApi(config('kavenegar.apikey'));
//        $sender = "";		//This is the Sender number	//The body of SMS
//
//        $receptor = array($phone);			//Receptors numbers
//
//        $result = $kavenegar->Send($sender,$receptor,$message);
//        if($result){
//            return true;
//        }
//    }
//    catch(\Kavenegar\Exceptions\ApiException $e){
//        // در صورتی که خروجی وب سرویس 200 نباشد این خطا رخ می دهد
//        echo $e->errorMessage();
//    }
//    catch(\Kavenegar\Exceptions\HttpException $e){
//        // در زمانی که مشکلی در برقرای ارتباط با وب سرویس وجود داشته باشد این خطا رخ می دهد
//        return $e->errorMessage();
//    }catch(\Exception $ex){
//        // در صورت بروز خطایی دیگر
//        return $ex->getMessage();
//    }
}

function sms_meli_send($message,$phone)
{
    $data=array('username' =>config('melipayamak.username'), 'password'=>config('melipayamak.password'), 'to' =>$phone, 'from' => "50002710026950", "text" =>$message);
    $post_data = http_build_query($data);
    $handle = curl_init('https://rest.payamak-panel.com/api/SendSMS/SendSMS');
    curl_setopt($handle, CURLOPT_HTTPHEADER, array(
        'content-type' => 'application/x-www-form-urlencoded'
    ));
    curl_setopt($handle, CURLOPT_RETURNTRANSFER, true);
    curl_setopt($handle, CURLOPT_SSL_VERIFYHOST, false);
    curl_setopt($handle, CURLOPT_SSL_VERIFYPEER, false);
    curl_setopt($handle, CURLOPT_POST, true);
    curl_setopt($handle, CURLOPT_POSTFIELDS, $post_data);
    $response = curl_exec($handle);
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
