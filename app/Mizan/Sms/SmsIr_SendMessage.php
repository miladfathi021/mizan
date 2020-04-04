<?php


namespace App\Mizan\Sms;


use Illuminate\Support\Facades\Http;

class SmsIr_sendMessage
{
    public $token;
    public $phone;
    public $message;

    public function __construct($token, $phone, $message)
    {
        $this->token = $token;
        $this->phone = $phone;
        $this->message = $message;
    }

    public function store()
    {
//        dd($this->token );
        $phone = [$this->phone];

        $message = [];
        $message[] = $this->message;

        $result = Http::withHeaders([
            'x-sms-ir-secure-token' => $this->token
        ])->post('https://RestfulSms.com/api/MessageSend', [
            "Messages" => $message,
            "MobileNumbers" => $phone,
            "LineNumber" => "50002015301635",
            "SendDateTime" => "",
            "CanContinueInCaseOfError" => "false",
        ]);

        if(!$result->json()['IsSuccessful'] == true) {
            return $this->store();
        }

        return true;
    }
}
