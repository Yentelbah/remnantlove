<?php

namespace App\Notifications;

use App\Services\SmsService;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Messages\MailMessage;
use Illuminate\Notifications\Notification;

class LoanDeclinedNotification extends Notification
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
            'message' => "Dear {$this->loan->client->fname}, your loan application (Loan ID: {$this->loan->loanID}) has been declined. Please contact us for more information.",
        ];
    }

    public function sendSMS()
    {
        $smsService = app(SmsService::class);
        $message = "Dear {$this->loan->client->fname}, your loan application (Loan ID: {$this->loan->loanID}) has been declined. Please contact us for more information.";
        $smsService->sendSMS($this->loan->client->phone, null, $message);
    }
}
