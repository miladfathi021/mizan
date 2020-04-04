<?php

namespace App\Events;

use App\Mizan\Lawyer\GenderStatusManagement;
use Illuminate\Broadcasting\Channel;
use Illuminate\Broadcasting\InteractsWithSockets;
use Illuminate\Broadcasting\PresenceChannel;
use Illuminate\Broadcasting\PrivateChannel;
use Illuminate\Contracts\Broadcasting\ShouldBroadcast;
use Illuminate\Foundation\Events\Dispatchable;
use Illuminate\Queue\SerializesModels;

class AccountInformationToLawyerEvent
{
    use Dispatchable, InteractsWithSockets, SerializesModels;

    public $phone;
    public $message;

    /**
     * Create a new event instance.
     *
     * @param $user
     * @param $password
     */
    public function __construct($user, $password)
    {
        $this->phone = $user['phone'];
        $gender = $user->lawyer->gender == GenderStatusManagement::STATUS_MALE ? 'جناب آقای' : 'سرکار خانم';
        $this->message = $gender . " " . $user['name'] . " حساب شما در میزان با موفقیت ایجاد شد لطفا با اطلاعات زیر وارد سایت شوید." . " شماره موبایل:‌ 0" . $user['phone'] . " کلمه عبور: " . $password;
    }
}
