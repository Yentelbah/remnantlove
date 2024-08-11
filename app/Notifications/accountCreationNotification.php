<?php

namespace App\Notifications;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Messages\MailMessage;
use Illuminate\Notifications\Notification;
use App\Services\SmsService;

class accountCreationNotification extends Notification implements ShouldQueue
{
    use Queueable;

    protected $phone;
    protected $message;

    public function __construct($phone, $message)
    {
        $this->phone = $phone;
        $this->message = $message;
    }

    public function sendSMS()
    {
        $smsService = app(SmsService::class);
        $message = "{$this->message}";
        $smsService->sendSMS($this->phone, null, $message);
    }
}
