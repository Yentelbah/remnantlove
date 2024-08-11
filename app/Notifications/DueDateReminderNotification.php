<?php

namespace App\Notifications;

use App\Services\SmsService;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Messages\MailMessage;
use Illuminate\Notifications\Notification;

class DueDateReminderNotification extends Notification
{
    private $loan;

    public function __construct($loan)
    {
        $this->loan = $loan;
    }

    public function via($notifiable)
    {
        return ['database'];
    }

    public function toArray($notifiable)
    {
        return [
            'message' => "Dear {$this->loan->client->fname}, your loan (Loan ID: {$this->loan->loanID}) is due in a few days. Please ensure timely repayment to avoid penalties.",
        ];
    }

    public function sendSMS()
    {
        $smsService = app(SmsService::class);
        $message = "Dear {$this->loan->client->fname}, your loan (Loan ID: {$this->loan->loanID}) is due in a few days. Please ensure timely repayment to avoid penalties.";
        $smsService->sendSMS($this->loan->client->phone, null, $message);
    }
}
