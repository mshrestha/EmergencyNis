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
        return (new MailMessage)
            ->greeting('Dear '.$this->employee_info->full_name)
            ->subject('[Auto Generated] Monthly Nutrition Sector Report, MAY 2020')
            ->line('Under the dynamic leadership of Civil Surgeon, Cox’s Bazar, the Nutrition Sector is pleased to share 
            Monthly Online Emergency Nutrition Report (ENR) for May 2020. This report is automatically generated from online 
            nutrition sector portal https://emergencynutrition.org/ with data shared by all nutrition sector partners using 
            Emergency Nutrition Information Module (ENIM) and other data systems. For detailed report and status by each 
            implementing partner or facility, please visit the above website.')
            ->line('<img src="http://beta.emergencynutrition.org/img/may_2020.jpg">')
            ->line('• Overall, 18,898 for malnourished boys and girls under five, pregnant and lactating women were 
            admitted to the nutrition treatment and preventive services since January 2020.')
            ->line('• In May 872 SAM children were admitted and in April 447 SAM children were reached,  therefore the admission rate has doubled.')
            ->line('• Also 5,693 MAM children received targeted supplementary feeding compared to 1,862 children in April-which almost 3 fold increase.')
            ->line('• 21,161 new pregnant and lactating women and caregivers of children reached by IYCF counselling and 
            participated in the IYCF group sessions. In May, additional 8,584 children women were reached compared 12,577 women in April.')
            ->line('For further information, please contact with info@nutritionsector.org ')

            ->attach(public_path('pdf/ENIMDashboardSnaoshotMay2020-EmergencyNutritionSectorCoxsBazar.pdf'), [
                'as' => 'ENIMDashboardSnaoshotMay2020-EmergencyNutritionSectorCoxsBazar.pdf',
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
