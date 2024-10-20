<?php

namespace App\Notifications;

use Carbon\Carbon;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Messages\MailMessage;
use Illuminate\Notifications\Notification;

class TaskAssignedNotification extends Notification
{
    use Queueable;

    protected $task;

    /**
     * Create a new notification instance.
     */
    public function __construct($task)
    {
        $this->task = $task;
    }

    /**
     * Get the notification's delivery channels.
     *
     * @return array<int, string>
     */
    public function via(object $notifiable): array
    {
        return ['mail',];
    }

    /**
     * Get the mail representation of the notification.
     */
    public function toMail(object $notifiable): MailMessage
    {
        return (new MailMessage)
                    ->subject('New Task Assigned: ' . $this->task->title)
                    ->line('A new task has been assigned to you: ' . $this->task->title)
                    ->line('Description: ' . $this->task->description)
                    ->line('Due Date: ' . Carbon::parse($this->task->due_date)->format('d M, Y'))
                    ->action('View Task', url('/task/'.$this->task->id)) // Link to task page
                    ->line('Thank you!');
    }

    /**
     * Get the array representation of the notification.
     *
     * @return array<string, mixed>
     */
    public function toArray(object $notifiable): array
    {
        return [
            //
        ];
    }

    public function toDatabase($notifiable)
    {
        return [
            'task_id' => $this->task->id,
            'message' => 'A new task has been assigned to you: ' . $this->task->title,
        ];
    }


}
