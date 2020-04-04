<?php

namespace App\Listeners;

use App\Events\PhoneVerificationEvent;
use App\Mizan\Sms\SmsIr_sendMessage;
use App\Mizan\Sms\SmsIr_GetToken;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Queue\InteractsWithQueue;

class sendVerificationCodeRegisteredNewAccountSmsNotification
{
    /**
     * Create the event listener.
     *
     * @return void
     */
    public function __construct()
    {
        //
    }

    /**
     * Handle the event.
     *
     * @param PhoneVerificationEvent $event
     * @return void
     */
    public function handle(PhoneVerificationEvent $event)
    {
        $token = new SmsIr_GetToken();
        $token = $token->store();

        $send = new SmsIr_sendMessage($token, $event->phone, $event->message);
        $send->store();


    }
}
