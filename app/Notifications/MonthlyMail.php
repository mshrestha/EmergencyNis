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
            ->subject('[Auto Generated] Monthly Nutrition Sector Report, July 2020')
            ->line('Under the dynamic leadership of Civil Surgeon, Cox’s Bazar, the Nutrition Sector is pleased to 
            share Monthly Online Emergency Nutrition Report (ENR) for July 2020. This report is automatically generated 
            from online nutrition sector portal https://emergencynutrition.org/ with data shared by all nutrition sector 
            partners using Emergency Nutrition Information Module (ENIM) and other data systems. For detailed report and 
            status by each implementing partner or facility, please visit the above website.')
            ->line('<img src="http://beta.emergencynutrition.org/img/july_2020.jpg">')

            ->line('• Overall, 38,352 for malnourished boys and girls under five, pregnant and lactating women were 
            admitted to the nutrition treatment and preventive services since January 2020.')
            ->line('• In July 1,019 SAM children were admitted and in June 1,597 SAM children were reached, therefore 
            the admission rate falls to one third. As of July, 1,5667 number of SAM children have been admitted, which is 41%  of the overall target')
            ->line('• Also, 7,236 MAM children received targeted supplementary feeding compared to 9,347 children in 
            June-which almost 29% decrease.')
            ->line('• 3,737  new pregnant and lactating women and caregivers of children reached by IYCF counseling 
            and participated in the IYCF group sessions. In June, 3,111 PLW reached by IYCF counselling, besides 31,716 
            children women were reached by IYCF messaging through VAS campaign.')
            ->line('• The Vitamin A supplementation event, held between 21 June 2020  to 20 July 2020 reached over 
            81,462 boys and 78,564 girls under five-so the overall coverage was  97 %. During the event, fom a totally of 
            155,217 screened for malnutrition children under five, 745 were new SAM and 6,520 new MAM children. Besides that,  
            All children were referred to the respective nutrition (OTP, TSFP) and disability caring services.')
            ->line('• In the last 4 months, only 15 children admitted in Stabilization Centre, whereas 33 children 
            alone were admitted in March 2020')

            ->line('For further information, please contact with info@nutritionsector.org ')

            ->attach(public_path('pdf/ENIMDashboardJuly2020-EmergencyNutritionSectorCoxsBazar.pdf'), [
                'as' => 'ENIMDashboardJuly2020-EmergencyNutritionSectorCoxsBazar.pdf',
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
