<?php

namespace App\Notifications;

use Illuminate\Bus\Queueable;
use Illuminate\Notifications\Notification;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Messages\MailMessage;

class MonthlyMail extends Notification
{
    use Queueable;
    public $employee_info;


    /**
     * Create a new notification instance.
     *
     * @return void
     */
    public function __construct($employee_info)
    {
        $this->employee_info=$employee_info;

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
//        return (new MailMessage)
//                    ->line('The introduction to the notification.')
//                    ->action('Notification Action', url('/'))
//                    ->line('Thank you for using our application!');
        return (new MailMessage)
            ->greeting('Hello,  '.$this->employee_info->full_name)
            ->subject('Monthly Mail from Unicef')
            ->line('this is a test mail from Development Environment')
            ->line('Please download the PDF.')
            ->line('Thank you!')

            ->attach(public_path('pdf/open_dashboard.pdf'), [
                'as' => 'open_dashboard.pdf',
                'mime' => 'text/pdf',
            ]);

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
