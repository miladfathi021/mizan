<?php


namespace App\Mizan\Sms;


use Illuminate\Support\Facades\Http;

class SmsIr_GetToken
{

    public $apiKey;
    public $secretKey;

    public function __construct()
    {
        $this->apiKey = env('API_KEY_SMSIR');
        $this->secretKey = env('SECURITY_CODE_SMSIR');
    }

    public function store()
    {
        $token = Http::post('https://RestfulSms.com/api/Token', [
            "UserApiKey" => $this->apiKey,
	        "SecretKey" => $this->secretKey,
        ]);

        if ($token->json()['IsSuccessful'] == true) {
            return $token->json()['TokenKey'];
        }

        return $this->store();
    }

}
