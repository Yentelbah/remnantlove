<?php

namespace App\Notifications;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Messages\MailMessage;
use Illuminate\Notifications\Notification;
use App\Services\SmsService;

class FundsDisbursedNotification extends Notification
{
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
            'message' => "We are happy to inform you that the funds for your approved loan (Loan ID: {$this->loan->loanID}) have been disbursed to your account. The disbursed amount is {$this->loan->amount}. Thank you for choosing us.",
        ];
    }

    public function sendSMS()
    {
        $smsService = app(SmsService::class);
        $message = "We are happy to inform you that the funds for your approved loan (Loan ID: {$this->loan->loanID}) have been disbursed to your account. The disbursed amount is {$this->loan->amount}. Thank you for choosing us.";
        $smsService->sendSMS($this->loan->client->phone, null, $message);
    }
}
