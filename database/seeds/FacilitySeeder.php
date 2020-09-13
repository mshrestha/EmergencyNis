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
            ['id' => '2','name' => 'UNHCR'],
        ];
        \DB::table('implementing_partners')->insert($implementing_partner);

    }
}
