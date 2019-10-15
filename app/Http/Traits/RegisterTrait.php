<?php
namespace App\Http\Traits;

use App\Register;
trait RegistersTrait {
   
    public function findDataFromFacilityFollowup($data){
        $dashboard['cureRate'] =  0;
        $dashboard['deathRate'] = 0;
        $dashboard['defaultRate'] = 0;
        $dashboard['nonRespondantRate'] = 0;
        $dashboard['count']=0;
        foreach($data as $child){
            if($child->discharge_criteria_exit == 'Recovered'){
                $dashboard['cureRate']++;
            }
            if($child->discharge_criteria_exit == 'Death'){
                $dashboard['deathRate']++;
            }
            if($child->discharge_criteria_exit == 'Defaulted'){
                $dashboard['defaultRate']++;
            }
            if(isset($child->discharge_criteria_exit)){
                $dashboard['count']++;
            }
            if($child->new_admission == ''){
                
            }   
        }
        if($dashboard['count'] == 0){
            $rate['cureRate'] = 0;
            $rate['deathRate'] = 0;
            $rate['defaultRate'] = 0;
            $rate['nonRespondantRate'] = 0;
        }else{
            $rate['cureRate'] = $dashboard['cureRate'] / $dashboard['count'] * 100;
            $rate['deathRate'] = $dashboard['deathRate'] / $dashboard['count'] * 100;
            $rate['defaultRate'] = $dashboard['defaultRate'] / $dashboard['count'] * 100;
            $rate['nonRespondantRate'] = $dashboard['nonRespondantRate'] / $dashboard['count'] * 100;    
        }
        
        return $rate;
        
    }
}