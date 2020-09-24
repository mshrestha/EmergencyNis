<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;
use Illuminate\Support\Facades\DB;

class ChangeFieldNullableToFacilityFollowups extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('facility_followups', function (Blueprint $table) {
            DB::statement("ALTER TABLE facility_followups CHANGE received_all_epi_vaccination received_all_epi_vaccination TINYINT(1) NULL DEFAULT '0'");
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('facility_followups', function (Blueprint $table) {
            DB::statement("ALTER TABLE facility_followups CHANGE received_all_epi_vaccination received_all_epi_vaccination TINYINT(1) DEFAULT '0'");
        });
    }
}
