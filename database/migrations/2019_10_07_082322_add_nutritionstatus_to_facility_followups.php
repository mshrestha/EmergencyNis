<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AddNutritionstatusToFacilityFollowups extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('facility_followups', function (Blueprint $table) {
            $table->enum('nutritionstatus', ['SAM', 'MAM', 'Normal'])->nullable();
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
            //
        });
    }
}
