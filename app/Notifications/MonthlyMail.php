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
            ->greeting('Dear '.$this->employee_info->full_name)
            ->subject('[Auto Generated] Monthly Nutrition Sector Report, APRIL 2020')
            ->line('Under the dynamic leadership and guidance of our honorable Minister, respectable Secretary sir, HSD, Ministry of Health and Family welfare and respectable DG sir of DGHS Prof. Abul Kalam Azad, National Nutrition Services (NNS), Institute of Public Health Nutrition (IPHN) and Civil Surgeon, Cox’s Bazar, the Nutrition Sector is pleased to share Monthly Online Emergency Nutrition Report (ENR) for April 2020.')
            ->line('This report is automatically generated from online nutrition sector portal https://emergencynutrition.org/ with  data shared by all nutrition sector partners using Emergency Nutrition Information Module (ENIM) and other data systems. For detailed report and status by each implementing partner or facility, please visit the above website.')
            ->line('<img src="http://beta.emergencynutrition.org/img/april2020.jpg">')
            ->line('•	12,493 for malnourished boys and girls under five, pregnant and lactating women were admitted to the nutrition treatment and preventive services during April 2020. It includes 447 SAM children;1,585 MAM children and 27 MAM pregnant and lactating women.')
            ->line('•	178,989 boys and girls aged 6-59 months and PLW reached with Blanket Supplementary Feeding Programme.')
            ->line('•	12,577 new pregnant and lactating women and caregivers of children reached by IYCF counselling and participated in the IYCF group sessions.')
            ->line('For further information, please contact with info@nutritionsector.org ')


            ->attach(public_path('pdf/april_2020.pdf'), [
                'as' => 'april_2020.pdf',
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
