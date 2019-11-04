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
            
            'year'=> $row[0],
            'month'=> $row[1],
            'programPartner'=> $row[2],
            'partner'=> $row[3],
            'campSattlement'=> $row[4],
            'siteName'=> $row[5],
            'reportingStatus'=> $row[6],
            'extendedCriteria'=> $row[7],
            'age'=> $row[8],
            'biginingMonth_M'=> $row[9],
            'biginingMonth_F'=> $row[10],
            'biginingMonthTotal'=> $row[11],
            'enrolmentMuc_M'=> $row[12],
            'enrolmentMuc_F'=> $row[13],
            'enrolmentWfh_M'=> $row[14],
            'enrolmentWfh_F'=> $row[15],
            'enrolmentEdema_M'=> $row[16],
            'enrolmentEdema_F'=> $row[17],
            'enrolmentRelapse_M'=> $row[18],
            'enrolmentRelapse_F'=> $row[19],
            'totalNewEnrolment_M'=> $row[20],
            'totalNewEnrolment_F'=> $row[21],
            'totalNewEnrolment'=> $row[22],
            'transferDefult_M'=> $row[23],
            'transferDefult_F'=> $row[24],
            'transferFromTsfp_M'=> $row[25],
            'transferFromTsfp_F'=> $row[26],
            'transferFromInp_M'=> $row[27],
            'transferFromInp_F'=> $row[28],
            'transferOtherOtp_M'=> $row[29],
            'transferOtherOtp_F'=> $row[30],
            'totalTransferIn_M'=> $row[31],
            'totalTransferIn_F'=> $row[32],
            'totalTransferIn'=> $row[33],
            'totalEnrolment_M'=> $row[34],
            'totalEnrolment_F'=> $row[35],
            'totalEnrolment'=> $row[36],
            'Recovered_M'=> $row[37],
            'Recovered_F'=> $row[38],
            'Death_M'=> $row[39],
            'Death_F'=> $row[40],
            'Default_M'=> $row[41],
            'Default_F'=> $row[42],
            'nonRecovered_M'=> $row[43],
            'nonRecovered_F'=> $row[44],
            'totalDischarged_M'=> $row[45],
            'totalDischarged_F'=> $row[46],
            'totalDischarged'=> $row[47],
            'medicalTrnsfer_M'=> $row[48],
            'medicalTrnsfer_F'=>$row[49] ,
            'unknown_M'=> $row[50],
            'unknown_F'=> $row[51],
            'transferSc_M'=> $row[52],
            'transferSc_F'=> $row[53],
            'transfOtherOtp_M'=> $row[54],
            'transfOtherOtp_F'=> $row[55],
            'totalExit_M'=> $row[56],
            'totalExit_F'=> $row[57],
            'totalExit'=> $row[58],
            'totalEndOfMonth_M'=> $row[59],
            'totalEndOfMonth_F'=> $row[60],
            'totalEndOfMonth'=> $row[61],
            'totalTransferFromOther'=> $row[62],
            'totalCured'=> $row[63],
            'totalDeath'=> $row[64],
            'totalDefault'=> $row[65],
            'totalNonRecovered'=> $row[66],
            'curedRate'=> $row[67],
            'deathRate'=> $row[68],
            'defaultRate'=> $row[69],
            'nonRecoveredRate'=> $row[70],
            'totalNewAdmissionCalculated'=> $row[71],
            'difference'=> $row[72],
            'los'=> $row[73],
            'awg'=> $row[74],
            
        ]);
    }

}
