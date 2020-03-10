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

    public $phone_verification;

    /**
     * Create a new event instance.
     *
     * @param $phone_verification
     */
    public function __construct($phone_verification)
    {
        $this->phone_verification = $phone_verification;
    }
}
