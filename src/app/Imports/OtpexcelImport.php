<?php

namespace App\Imports;

use App\OtpImport;
use Maatwebsite\Excel\Concerns\ToModel;
use Maatwebsite\Excel\Concerns\WithStartRow;

use Illuminate\Http\Request;
class OtpexcelImport implements ToModel,WithStartRow
{
    /**
    * @param array $row
    *
    * @return \Illuminate\Database\Eloquent\Model|null
    */
    public function startRow(): int
    {
        return 4;
    }
    public function model(array $row)
    {
//        dd($row);
        return new OtpImport([

            'period'=> $row[0],
            'year'=> $row[1],
            'month'=> $row[2],
            'programPartner'=> $row[3],
            'partner'=> $row[4],
            'campSettlement'=> $row[5],
            'siteName'=> $row[6],

            'campId'=> $row[7],

//            'reportingStatus'=> $row[7],
            'extendedCriteria'=> $row[8],
            'age'=> $row[9],
            'beginningMonth_M'=> $row[10],
            'beginningMonth_F'=> $row[11],
            'beginningMonthTotal'=> $row[12],
            'enrolmentMuc_M'=> $row[13],
            'enrolmentMuc_F'=> $row[14],
            'enrolmentWfh_M'=> $row[15],
            'enrolmentWfh_F'=> $row[16],

            'enrolmentBoth_M'=> $row[17],
            'enrolmentBoth_F'=> $row[18],

            'enrolmentEdema_M'=> $row[19],
            'enrolmentEdema_F'=> $row[20],
            'enrolmentRelapse_M'=> $row[21],
            'enrolmentRelapse_F'=> $row[22],

            'transferFromBsfp_M'=> $row[23],
            'transferFromBsfp_F'=> $row[24],
            'inpatientTreatment_M'=> $row[25],
            'inpatientTreatment_F'=> $row[26],

            'totalNewEnrolment_M'=> $row[27],
            'totalNewEnrolment_F'=> $row[28],
            'totalNewEnrolment'=> $row[29],
            'transferDefault_M'=> $row[30],
            'transferDefault_F'=> $row[31],
            'transferFromTsfp_M'=> $row[32],
            'transferFromTsfp_F'=> $row[33],
            'transferFromInp_M'=> $row[34],
            'transferFromInp_F'=> $row[35],
            'transferInOtherOtp_M'=> $row[36],
            'transferInOtherOtp_F'=> $row[37],
            'totalTransferIn_M'=> $row[38],
            'totalTransferIn_F'=> $row[39],
            'totalTransferIn'=> $row[40],
            'totalEnrolment_M'=> $row[41],
            'totalEnrolment_F'=> $row[42],
            'totalEnrolment'=> $row[43],
            'recovered_M'=> $row[44],
            'recovered_F'=> $row[45],
            'death_M'=> $row[46],
            'death_F'=> $row[47],
            'default_M'=> $row[48],
            'default_F'=> $row[49],
            'nonRecovered_M'=> $row[50],
            'nonRecovered_F'=> $row[51],
            'totalDischarged_M'=> $row[52],
            'totalDischarged_F'=> $row[53],
            'totalDischarged'=> $row[54],
            'medicalTransfer_M'=> $row[55],
            'medicalTransfer_F'=>$row[56] ,
            'unknown_M'=> $row[57],
            'unknown_F'=> $row[58],
            'transferSc_M'=> $row[59],
            'transferSc_F'=> $row[60],
            'transferOutOtherOtp_M'=> $row[61],
            'transferOutOtherOtp_F'=> $row[62],
            'totalExit_M'=> $row[63],
            'totalExit_F'=> $row[64],
            'totalExit'=> $row[65],
            'totalEndOfMonth_M'=> $row[66],
            'totalEndOfMonth_F'=> $row[67],
            'totalEndOfMonth'=> $row[68],
            'totalTransferFromOther'=> $row[69],
            'totalCured'=> $row[70],
            'totalDeath'=> $row[71],
            'totalDefault'=> $row[72],
            'totalNonRecovered'=> $row[73],
            'curedRate'=> $row[74],
            'deathRate'=> $row[75],
            'defaultRate'=> $row[76],
            'nonRecoveredRate'=> $row[77],
            'totalNewAdmissionCalculated'=> $row[78],
            'difference'=> $row[79],
            'alos'=> $row[78],
            'awg'=> $row[81],
            
        ]);
    }

}
