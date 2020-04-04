<?php

namespace App\Events;

use Illuminate\Broadcasting\Channel;
use Illuminate\Broadcasting\InteractsWithSockets;
use Illuminate\Broadcasting\PresenceChannel;
use Illuminate\Broadcasting\PrivateChannel;
use Illuminate\Contracts\Broadcasting\ShouldBroadcast;
use Illuminate\Foundation\Events\Dispatchable;
use Illuminate\Queue\SerializesModels;

class PhoneVerificationEvent
{
    use Dispatchable, InteractsWithSockets, SerializesModels;

    public $phone;
    public $message;

    /**
     * Create a new event instance.
     *
     * @param $phone
     */
    public function __construct($phone)
    {
        $this->phone = $phone['phone'];
        $this->message = "کد فعالسازی: " . $phone['code'] . " میزان";
    }
}
