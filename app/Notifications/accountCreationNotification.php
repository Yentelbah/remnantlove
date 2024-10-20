<?php

namespace App\Notifications;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Notification;
use App\Services\SmsService;

class accountCreationNotification extends Notification implements ShouldQueue
{
    use Queueable;

    protected $phone;
    protected $senderID;
    protected $message;
    protected $schedule;
    protected $delivery;


    public function __construct($phone, $senderID, $message,  $schedule, $delivery)
    {
        $this->phone = $phone;
        $this->senderID = $senderID;
        $this->message = $message;
        $this->schedule = $schedule;
        $this->delivery = $delivery;

    }

    public function sendSMS()
    {
        $smsService = app(SmsService::class);
        $message = "{$this->message}";
        $smsService->sendSMS($this->phone, $this->senderID, $message, $this->schedule, $this->delivery);
    }
}
