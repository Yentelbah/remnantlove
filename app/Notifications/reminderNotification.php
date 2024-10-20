<?php

namespace App\Notifications;

use App\Models\SenderID;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Messages\MailMessage;
use Illuminate\Notifications\Notification;
use App\Services\SmsService;

class reminderNotification extends Notification implements ShouldQueue
{
    use Queueable;

    protected $phone;
    protected $message;
    protected $senderID;
    protected $schedule;
    protected $delivery;

    public function __construct($phone, $message, $senderID, $schedule, $delivery)
    {
        $this->phone = $phone;
        $this->message = $message;
        $this->senderID = $senderID;
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
