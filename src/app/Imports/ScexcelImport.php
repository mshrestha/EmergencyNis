<?php

namespace App\Imports;

use App\ScImport;
use Maatwebsite\Excel\Concerns\ToModel;
use Maatwebsite\Excel\Concerns\WithStartRow;


class ScexcelImport implements ToModel, WithStartRow
{
    /**
     * @param array $row
     *
     * @return \Illuminate\Database\Eloquent\Model|null
     */
    public function startRow(): int
    {
        return 5;
    }

    public function model(array $row)
    {
        return new ScImport([

            'period' => $row[0],
            'year' => $row[1],
            'month' => $row[2],
            'programPartner' => $row[3],
            'partner' => $row[4],
            'campSettlement' => $row[5],
            'siteName' => $row[6],
            'campId' => $row[7],

            'reportMode' => $row[8],
            'ageGroup'=> $row[9],
            'beginningMonth_M'=> $row[10],
            'beginningMonth_F'=> $row[11],
            'beginningMonthTotal'=> $row[12],
            'newAdmissionWfh_M'=> $row[13],
            'newAdmissionWfh_F'=> $row[14],
            'newAdmissionMuc_M'=> $row[15],
            'newAdmissionMuc_F'=> $row[16],
            'newAdmissionEdema_M'=> $row[17],
            'newAdmissionEdema_F'=> $row[18],
            'newAdmissionRelapse_M'=> $row[19],
            'newAdmissionRelapse_F'=> $row[20],
            'totalNewAdmission_M'=> $row[21],
            'totalNewAdmission_F'=> $row[22],
            'totalNewAdmission'=> $row[23],
            'readmissionAfterDefault_M'=> $row[24],
            'readmissionAfterDefault_F'=> $row[25],
            'transferInFromOtp_M'=> $row[26],
            'transferInFromOtp_F'=> $row[27],
            'totalEntries_M'=> $row[28],
            'totalEntries_F'=> $row[29],
            'totalEntries'=> $row[30],
            'recovered_M'=> $row[31],
            'recovered_F'=> $row[32],
            'death_M'=> $row[33],
            'death_F'=> $row[34],
            'default_M'=> $row[35],
            'default_F'=> $row[36],
            'nonRecovered_M'=> $row[37],
            'nonRecovered_F'=> $row[38],
            'unknown_M'=> $row[39],
            'unknown_F'=> $row[40],
            'medicalTransfer_M'=> $row[41],
            'medicalTransfer_F'=> $row[42],
            'transferToOtp_M'=> $row[43],
            'transferToOtp_F'=> $row[44],
            'totalDischarged_M'=> $row[45],
            'totalDischarged_F'=> $row[46],
            'totalDischarged'=> $row[47],
            'exitOther_M'=> $row[48],
            'exitOther_F'=> $row[49],
            'totalExit_M'=> $row[50],
            'totalExit_F'=> $row[51],
            'totalExit'=> $row[52],
            'totalEndOfMonth_M'=> $row[53],
            'totalEndOfMonth_F'=> $row[54],
            'totalEndOfMonth'=> $row[55],
            'alos'=> $row[56],
            'awg'=> $row[57],
        ]);
    }
}
