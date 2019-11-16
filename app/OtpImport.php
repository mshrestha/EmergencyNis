<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class OtpImport extends Model
{
    public $fillable = [
        'period',
        'year',
        'month',
        'programPartner',
        'partner',
        'campSettlement',
        'siteName',
        'campId',
//        'reportingStatus',
        'extendedCriteria',
        'age',
        'beginningMonth_M',
        'beginningMonth_F',
        'beginningMonthTotal',
        'enrolmentMuc_M',
        'enrolmentMuc_F',
        'enrolmentWfh_M',
        'enrolmentWfh_F',
        'enrolmentBoth_M',
        'enrolmentBoth_F',
        'enrolmentEdema_M',
        'enrolmentEdema_F',
        'enrolmentRelapse_M',
        'enrolmentRelapse_F',
        'transferFromBsfp_M',
        'transferFromBsfp_F',
        'inpatientTreatment_M',
        'inpatientTreatment_F',
        'totalNewEnrolment_M',
        'totalNewEnrolment_F',
        'totalNewEnrolment',
        'transferDefault_M',
        'transferDefault_F',
        'transferFromTsfp_M',
        'transferFromTsfp_F',
        'transferFromInp_M',
        'transferFromInp_F',
        'transferInOtherOtp_M',
        'transferInOtherOtp_F',
        'totalTransferIn_M',
        'totalTransferIn_F',
        'totalTransferIn',
        'totalEnrolment_M',
        'totalEnrolment_F',
        'totalEnrolment',
        'recovered_M',
        'recovered_F',
        'death_M',
        'death_F',
        'default_M',
        'default_F',
        'nonRecovered_M',
        'nonRecovered_F',
        'totalDischarged_M',
        'totalDischarged_F',
        'totalDischarged',
        'medicalTransfer_M',
        'medicalTransfer_F',
        'unknown_M',
        'unknown_F',
        'transferSc_M',
        'transferSc_F',
        'transferOutOtherOtp_M',
        'transferOutOtherOtp_F',
        'totalExit_M',
        'totalExit_F',
        'totalExit',
        'totalEndOfMonth_M',
        'totalEndOfMonth_F',
        'totalEndOfMonth',
        'totalTransferFromOther',
        'totalCured',
        'totalDeath',
        'totalDefault',
        'totalNonRecovered',
        'curedRate',
        'deathRate',
        'defaultRate',
        'nonRecoveredRate',
        'totalNewAdmissionCalculated',
        'difference',
        'alos',
        'awg',
    ];
}
