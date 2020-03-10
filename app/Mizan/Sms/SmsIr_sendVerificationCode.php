<?php


namespace App\Mizan\Sms;


use Illuminate\Support\Facades\Http;

class SmsIr_sendVerificationCode
{
    public $token;
    public $phone_verification;

    public function __construct($token, $phone_verification)
    {
        $this->token = $token;
        $this->phone_verification = $phone_verification;
    }

    public function store()
    {
//        dd($this->token);
        $phone = [$this->phone_verification['phone']];

        $message = [];
        $message[] = "کد ثبت نام: " . $this->phone_verification['code'] . " میزان";

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
