<?php

namespace App\Notifications;

use App\Services\SmsService;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Messages\MailMessage;
use Illuminate\Notifications\Notification;

class RepaymentReceivedNotification extends Notification
{
    private $loan;
    private $paymentAmount;
    private $remainingBalance;

    public function __construct($loan, $paymentAmount, $remainingBalance)
    {
        $this->loan = $loan;
        $this->paymentAmount = $paymentAmount;
        $this->remainingBalance = $remainingBalance;
    }

    public function via($notifiable)
    {
        return ['database'];
    }

    public function toArray($notifiable)
    {
        return [
            'message' => "Dear {$this->loan->client->fname}, we have received your repayment of {$this->paymentAmount} for loan ID: {$this->loan->loanID}.  Your current outstanding balance is {$this->remainingBalance}.  Thank you!",
        ];
    }

    public function sendSMS()
    {
        $smsService = app(SmsService::class);
        $message = "Dear {$this->loan->client->fname}, we have received your repayment of {$this->paymentAmount} for loan ID: {$this->loan->loanID}. Your current outstanding balance is {$this->remainingBalance}. Thank you!";
        $smsService->sendSMS($this->loan->client->phone, null, $message);
    }
}
