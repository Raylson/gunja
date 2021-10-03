<?php

namespace App\Http\Controllers;

use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Illuminate\Foundation\Bus\DispatchesJobs;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Support\Facades\Log;
use Illuminate\Routing\Controller as BaseController;

class Controller extends BaseController
{
    use AuthorizesRequests, DispatchesJobs, ValidatesRequests;

    public function requestToApp($url,$data){
        $ch = curl_init($url);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
        curl_setopt($ch, CURLOPT_HTTPHEADER,array());
        curl_setopt($ch, CURLOPT_CUSTOMREQUEST, "POST");
        curl_setopt($ch, CURLOPT_POSTFIELDS, $data);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
        curl_setopt($ch, CURLOPT_HTTPHEADER, array("Content-Type: multipart/form-data"));
        curl_setopt($ch, CURLOPT_TIMEOUT, 180);
        curl_setopt($ch, CURLOPT_CONNECTTIMEOUT, 180);
        curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);
        $result = curl_exec($ch);
        curl_close($ch);
        
        return $result;
    }

    public function callAPI($method = 'POST', $url, $data, $authorization='')
    {
        // for login we will not store the request data
        if($url != '/api/login')
            Log::channel('curlReq')->info('######################################---- Curl Request Start ----#################################'.PHP_EOL.'Method: '.$method.PHP_EOL.'URL: '.config('apiconfig.MIX_APP_URL').$url.PHP_EOL.'Request Data: '.$data);
        else
            Log::channel('curlReq')->info('######################################---- Curl Request Start ----#################################'.PHP_EOL.'Method: '.$method.PHP_EOL.'URL: '.config('apiconfig.MIX_APP_URL').$url.PHP_EOL);
        
        $headerArray = array("Content-Type: application/json");
        if($authorization)
            $headerArray = array("Content-Type: application/json", "Authorization: ".$authorization);

        $ch = curl_init(config('apiconfig.MIX_APP_URL').$url);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
        curl_setopt($ch, CURLOPT_CUSTOMREQUEST, $method);
        curl_setopt($ch, CURLOPT_POSTFIELDS, $data);
        curl_setopt($ch, CURLOPT_HTTPHEADER, $headerArray);
        curl_setopt($ch, CURLOPT_TIMEOUT, 180);
        curl_setopt($ch, CURLOPT_CONNECTTIMEOUT, 180);
        curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);
        $result = curl_exec($ch);
        curl_close($ch);

        Log::channel('curlReq')->info('Curl Response: '.$result.PHP_EOL);
        Log::channel('curlReq')->info('######################################---- Curl Request End ----#################################'.PHP_EOL);

        // to set the user_perms for the user if we get response from API
        $decodedData = json_decode($result);
        if(isset($decodedData->user_perms))
        {
            session(['user_perms' => $decodedData->user_perms]);
            unset($decodedData->user_perms);    // unset 'user_perms' from the response of the API
            $result = json_encode($decodedData);
        }

        return $result;
    }

    public function checkApiToken($token) {
        $api_token = $token;
        // if the user is loggedin by social media, api_token will not be set in localstorage
        if(str_contains($token, 'null'))
        {
            $userSession = session('user_login');
            if($userSession->provider != '')
            {
                $api_token = 'Bearer '.session('user_api_token');
            }
        }

        return $api_token;
    }

    protected function setLog($channel = 'curlReq', $message, $start = false, $end = false)
    {
        if ($start == true) {
            Log::channel($channel)->info('######################################----'.$message.'----#################################');
        }
        if ($start == false && $message != "") {
            Log::channel($channel)->info($message);
        }
        if ($end == true) {
            Log::channel($channel)->info("######################################--End of Log--#################################".PHP_EOL);
        }
    }

    public function setApiLog($channel='Category', $method, $request_data, $response_data)
    {
        Log::channel(config('logtype.'.$channel.'.log_channel'))->info('####################---- '.$channel.' Log ----####################'.PHP_EOL.'Method: '.$method.PHP_EOL.'Request Data: '.$request_data.PHP_EOL.'Response Data: '.$response_data.PHP_EOL);
    }
}
