<?php

namespace App\Notifications;

use App\Models\Examiner;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Messages\MailMessage;
use Illuminate\Notifications\Notification;

class ExaminerEnrollNotification extends Notification
{
    use Queueable;
    private $examiner;
    /**
     * Create a new notification instance.
     *
     * @return void
     */
    public function __construct(Examiner $examiner)
    {
        $this->examiner = $examiner;
    }

    /**
     * Get the notification's delivery channels.
     *
     * @param  mixed  $notifiable
     * @return array
     */
    public function via($notifiable)
    {
        return ['mail'];
    }

    /**
     * Get the mail representation of the notification.
     *
     * @param  mixed  $notifiable
     * @return \Illuminate\Notifications\Messages\MailMessage
     */
    public function toMail($notifiable)
    {
        return (new MailMessage)
                    ->line('Thank you for registering into ILO Encompass.')
                    ->action('Go to ILO ENCOMPASS ASSESSMENT page. Click Here.', url('/').'/exam-now/'.$this->examiner->unique_key)
                    ->line('Thank you for using ILO Encompass!');
    }

    /**
     * Get the array representation of the notification.
     *
     * @param  mixed  $notifiable
     * @return array
     */
    public function toArray($notifiable)
    {
        return [
            //
        ];
    }
}
