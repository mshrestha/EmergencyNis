<?php

namespace App\Imports;

use App\OtpImport;
use Maatwebsite\Excel\Concerns\ToModel;
use Maatwebsite\Excel\Concerns\WithStartRow;

class OtpexcelImport implements ToModel,WithStartRow
{
    /**
    * @param array $row
    *
    * @return \Illuminate\Database\Eloquent\Model|null
    */
    public function startRow(): int
    {
        return 2;
    }
    public function model(array $row)
    {
        return new OtpImport([
            
            'period'=> $row[0],
            'year'=> $row[1],
            'month'=> $row[2],
            'programPartner'=> $row[3],
            'partner'=> $row[4],
            'campSattlement'=> $row[5],
            'siteName'=> $row[6],
            'reportingStatus'=> $row[7],
            'extendedCriteria'=> $row[8],
            'age'=> $row[9],
            'biginingMonth_M'=> $row[10],
            'biginingMonth_F'=> $row[11],
            'biginingMonthTotal'=> $row[12],
            'enrolmentMuc_M'=> $row[13],
            'enrolmentMuc_F'=> $row[14],
            'enrolmentWfh_M'=> $row[15],
            'enrolmentWfh_F'=> $row[16],
            'enrolmentEdema_M'=> $row[17],
            'enrolmentEdema_F'=> $row[18],
            'enrolmentRelapse_M'=> $row[19],
            'enrolmentRelapse_F'=> $row[20],
            'totalNewEnrolment_M'=> $row[21],
            'totalNewEnrolment_F'=> $row[22],
            'totalNewEnrolment'=> $row[23],
            'transferDefult_M'=> $row[24],
            'transferDefult_F'=> $row[25],
            'transferFromTsfp_M'=> $row[26],
            'transferFromTsfp_F'=> $row[27],
            'transferFromInp_M'=> $row[28],
            'transferFromInp_F'=> $row[29],
            'transferOtherOtp_M'=> $row[30],
            'transferOtherOtp_F'=> $row[31],
            'totalTransferIn_M'=> $row[32],
            'totalTransferIn_F'=> $row[33],
            'totalTransferIn'=> $row[34],
            'totalEnrolment_M'=> $row[35],
            'totalEnrolment_F'=> $row[36],
            'totalEnrolment'=> $row[37],
            'Recovered_M'=> $row[38],
            'Recovered_F'=> $row[39],
            'Death_M'=> $row[40],
            'Death_F'=> $row[41],
            'Default_M'=> $row[42],
            'Default_F'=> $row[43],
            'nonRecovered_M'=> $row[44],
            'nonRecovered_F'=> $row[45],
            'totalDischarged_M'=> $row[46],
            'totalDischarged_F'=> $row[47],
            'totalDischarged'=> $row[48],
            'medicalTrnsfer_M'=> $row[49],
            'medicalTrnsfer_F'=>$row[50] ,
            'unknown_M'=> $row[51],
            'unknown_F'=> $row[52],
            'transferSc_M'=> $row[53],
            'transferSc_F'=> $row[54],
            'transfOtherOtp_M'=> $row[55],
            'transfOtherOtp_F'=> $row[56],
            'totalExit_M'=> $row[57],
            'totalExit_F'=> $row[58],
            'totalExit'=> $row[59],
            'totalEndOfMonth_M'=> $row[60],
            'totalEndOfMonth_F'=> $row[61],
            'totalEndOfMonth'=> $row[62],
            'totalTransferFromOther'=> $row[63],
            'totalCured'=> $row[64],
            'totalDeath'=> $row[65],
            'totalDefault'=> $row[66],
            'totalNonRecovered'=> $row[67],
            'curedRate'=> $row[68],
            'deathRate'=> $row[69],
            'defaultRate'=> $row[70],
            'nonRecoveredRate'=> $row[71],
            'totalNewAdmissionCalculated'=> $row[72],
            'difference'=> $row[73],
            'los'=> $row[74],
            'awg'=> $row[75],
            
        ]);
    }

}
