<?php

use Illuminate\Database\Seeder;

class FacilitySeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $program_partner = [
            ['id' => '1','name' => 'UNICEF'],
            ['id' => '2','name' => 'UNHCR'],
        ];
        \DB::table('program_partners')->insert($program_partner);

        $implementing_partner = [
            ['id' => '1','name' => 'ACF'],
            ['id' => '2','name' => 'CWW'],
            ['id' => '3','name' => 'SARPV'],
            ['id' => '4','name' => 'SCI'],
            ['id' => '5','name' => 'SHED'],
            ['id' => '6','name' => 'WC'],
            ['id' => '7','name' => 'WVI'],
        ];
        \DB::table('implementing_partners')->insert($implementing_partner);

        $ip_pp=[
            ['pp_id'=>'2','ip_id'=>'1'],
            ['pp_id'=>'1','ip_id'=>'2'],
            ['pp_id'=>'1','ip_id'=>'3'],
            ['pp_id'=>'2','ip_id'=>'3'],
            ['pp_id'=>'2','ip_id'=>'4'],
            ['pp_id'=>'1','ip_id'=>'5'],
            ['pp_id'=>'1','ip_id'=>'6'],
            ['pp_id'=>'1','ip_id'=>'7'],
        ];
        \DB::table('ip_pps')->insert($ip_pp);

    }
}
