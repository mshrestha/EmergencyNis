<?php


function getUsers()
{
    return DB::table('users')->get();
}
function summaryReport($reportStart, $reportEnd, $facility_id)
{
//    dd($facility_id);
    $summaryReport['registered_child']=\App\Models\Child::where('facility_id',$facility_id)
        ->whereBetween('registration_date', [$reportStart, $reportEnd])
        ->count();

    $summaryReport['child_followup']=\App\Models\FacilityFollowup::where('facility_id',$facility_id)
        ->whereBetween('date', [$reportStart, $reportEnd])
        ->count();

    $summaryReport['registered_women']=\App\Models\Child::where('facility_id',$facility_id)
        ->whereBetween('registration_date', [$reportStart, $reportEnd])
        ->count();

    $summaryReport['women_followup']=\App\Models\PregnantWomenFollowup::where('facility_id',$facility_id)
        ->whereBetween('actual_date', [$reportStart, $reportEnd])
        ->count();



    return $summaryReport;
}





