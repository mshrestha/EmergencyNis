<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class ChangeFieldDecimalToFacilityFollowupsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('facility_followups', function (Blueprint $table) {
            DB::statement("ALTER TABLE facility_followups MODIFY COLUMN wsb_plus_kg DECIMAL (5,2)");
            DB::statement("ALTER TABLE facility_followups MODIFY COLUMN wsb_plus_plus_kg DECIMAL (5,2)");
            DB::statement("ALTER TABLE facility_followups MODIFY COLUMN discharge_weight_kg DECIMAL (5,2)");
            DB::statement("ALTER TABLE facility_followups MODIFY COLUMN lowest_weight_kg DECIMAL (5,2)");
            DB::statement("ALTER TABLE facility_followups MODIFY COLUMN gain_of_weight DECIMAL (5,2)");
            DB::statement("ALTER TABLE facility_followups MODIFY COLUMN oil_kg DECIMAL (5,2)");
            DB::statement("ALTER TABLE facility_followups CHANGE others others VARCHAR (191)");
            $table->decimal('discharge_muac',5,2)->nullable();
            $table->enum('home_visit', ['Yes', 'No'])->nullable();

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
            DB::statement("ALTER TABLE facility_followups MODIFY COLUMN wsb_plus_kg INTEGER ");
            DB::statement("ALTER TABLE facility_followups MODIFY COLUMN wsb_plus_plus_kg INTEGER ");
            DB::statement("ALTER TABLE facility_followups MODIFY COLUMN discharge_weight_kg INTEGER ");
            DB::statement("ALTER TABLE facility_followups MODIFY COLUMN lowest_weight_kg INTEGER ");
            DB::statement("ALTER TABLE facility_followups MODIFY COLUMN gain_of_weight INTEGER ");
            DB::statement("ALTER TABLE facility_followups MODIFY COLUMN oil_kg INTEGER ");
            DB::statement("ALTER TABLE facility_followups CHANGE others others INTEGER ");
            $table->dropColumn('discharge_muac');
            $table->dropColumn('home_visit');
            //
        });
    }
}
