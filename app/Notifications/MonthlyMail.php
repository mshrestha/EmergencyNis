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
            ->subject('[Auto Generated] Monthly Nutrition Sector Report, June 2020')
            ->line('Under the dynamic leadership of Civil Surgeon, Cox’s Bazar, the Nutrition Sector is pleased to share 
            Monthly Online Emergency Nutrition Report (ENR) for June 2020. This report is automatically generated from online 
            nutrition sector portal https://emergencynutrition.org/ with data shared by all nutrition sector partners using 
            Emergency Nutrition Information Module (ENIM) and other data systems. For detailed report and status by each 
            implementing partner or facility, please visit the above website.')
            ->line('<img src="http://beta.emergencynutrition.org/img/june_2020.jpg">')

            ->line('• Overall, 29,886 for malnourished boys and girls under five, pregnant and lactating women were 
            admitted to the nutrition treatment and preventive services since January 2020.')
            ->line('• In June 1,597 SAM children were admitted and in May 872 SAM children were reached, therefore 
            the admission rate has doubled.')
            ->line('• Also 9,689 MAM children received targeted supplementary feeding compared to 5,693 children in 
            May-which almost 2 fold increase.')
            ->line('• 31,716 new pregnant and lactating women and caregivers of children reached by IYCF counselling 
            and participated in the IYCF group sessions. In May, additional 10,555 children women were reached.')
            ->line('• In addition Vitamin A supplementation activities reached over 92,000 children under five. 
            Within the Vitamin A community intervention, close to 4,000 new SAM and MAM cases were identified and enrolled 
            in the respective nutrition treatment programme.')
            ->line('• In last 3 months only 5 children admitted in Stabilization Centre, whereas there are 33 children 
            admitted on March 2020')

            ->line('For further information, please contact with info@nutritionsector.org ')

            ->attach(public_path('pdf/ENIMDashboardJune2020-EmergencyNutritionSectorCoxsBazar.pdf'), [
                'as' => 'ENIMDashboardJune2020-EmergencyNutritionSectorCoxsBazar.pdf',
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
