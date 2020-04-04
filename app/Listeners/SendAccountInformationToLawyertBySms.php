<?php

namespace App\Listeners;

use App\Events\AccountInformationToLawyerEvent;
use App\Mizan\Sms\SmsIr_GetToken;
use App\Mizan\Sms\SmsIr_sendMessage;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Queue\InteractsWithQueue;

class SendAccountInformationToLawyertBySms
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
     * @param AccountInformationToLawyerEvent $event
     * @return void
     */
    public function handle(AccountInformationToLawyerEvent $event)
    {
        $token = new SmsIr_GetToken();
        $token = $token->store();

        $send = new SmsIr_sendMessage($token, $event->phone, $event->message);
        $send->store();
    }
}
