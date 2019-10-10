<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class FacilityFollowup extends Model
{
    protected $fillable = [
    	'facility_id', 'children_id', 'refered_by', 'referal_slip_no', 'date', 'next_visit_date', 'age', 'attandance', 'muac', 'weight', 'height', 'wfh_z_score', 'oedema', 'medical_history_diarrhoea', 'medical_history_vomiting', 'medical_history_fever', 'medical_history_cough', 'medical_history_others', 'medical_history_others_detail', 'temperature', 'respiratory_rate', 'sign_of_dehydration', 'pneumonia', 'skin_changes', 'pale_conjunctiva', 'presence_of_appetite', 'new_admission', 'readmission', 'transfer_in', 'return_from', 'antibiotic', 'albendazole', 'no_of_rutf', 'no_of_rusf', 'wsb_plus_plus_kg', 'wsb_plus_kg', 'oil_kg', 'others', 'discharge_criteria_exit', 'discharge_criteria_transfer_out', 'discharge_criteria_others', 'discharge_weight_kg', 'lowest_weight_kg', 'duration_between_lowest_weight_and_discharged_weight_days', 'gain_of_weight', 'duration_between_discharged_and_admission_days', 'measles','nutritionstatus'
    ];

    public function child() {
    	return $this->belongsTo('App\Models\Child', 'children_id');
    }

    public function facility() {
    	return $this->belongsTo('App\Models\Facility', 'facility_id');
    }
}
