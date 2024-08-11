<?php

namespace App\Notifications;

use App\Services\SmsService;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Messages\MailMessage;
use Illuminate\Notifications\Notification;

class LoanDefaultedNotification extends Notification
{
    use Queueable;

    private $loan;

    public function __construct($loan)
    {
        $this->loan = $loan;
    }

    public function via($notifiable)
    {
        return ['database']; // Adjust as needed
    }

    public function toArray($notifiable)
    {
        return [
            'message' => "Dear {$this->loan->client->fname} , your loan with (Loan ID: {$this->loan->loanID}) has defaulted. The remaining balance and accrued interest will be rolled over into a new loan. Please contact us immediately to discuss the repayment. Thank you.",
        ];
    }

    public function sendSMS()
    {
        $smsService = app(SmsService::class);
        $message = "Dear {$this->loan->client->fname} , your loan with (Loan ID: {$this->loan->loanID}) has defaulted. The remaining balance and accrued interest will be rolled over into a new loan. Please contact us immediately to discuss the repayment. Thank you.";
        $smsService->sendSMS($this->loan->client->phone, null, $message);
    }
}
