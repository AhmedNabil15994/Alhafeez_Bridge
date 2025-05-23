<?php

namespace Modules\Apps\Services;

use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\URL;

class MagentoBridge
{
    public function __construct()
    {
        $this->apiUrl = env('MAGENTO_API_URL');
        $this->apiToken = env('MAGENTO_API_TOKEN');
        $this->mediaUrl = env('MAGENTO_MEDIA_URL');
    }

    public static function ErrorMessage($message = "Error in process, please try again later", $code = 400){
        $statusObj['status'] = new \stdClass();
        $statusObj['status']->status = 0;
        $statusObj['status']->code = $code;
        $statusObj['status']->message = $message;
        return (object) $statusObj;
    }

    public static function SuccessResponse($message = 'Data Generated Successfully'){
        $statusObj = new \stdClass();
        $statusObj->status = 1;
        $statusObj->code = 200;
        $statusObj->message = $message;
        return (object) $statusObj;
    }

    public function fireRequest($segment,$data,$type='post'){
        try {
            $response = Http::withToken($this->apiToken)->$type($this->apiUrl.$segment, $data);
            return json_decode($response->getBody(),true);
        }catch (\Exception $e){}
    }
}
