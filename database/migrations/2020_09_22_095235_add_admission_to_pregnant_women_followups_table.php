<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AddAdmissionToPregnantWomenFollowupsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('pregnant_women_followups', function (Blueprint $table) {
            $table->string('new_admission')->nullable();
            $table->string('readmission')->nullable();
            $table->string('transfer_in_from')->nullable();
            $table->string('referred_from')->nullable();
            $table->string('outcome')->nullable();
            $table->date('next_visit_date')->nullable();
            $table->date('planed_date')->nullable();
            $table->date('actual_date')->nullable();
            $table->enum('nutritionstatus', ['MAM', 'Normal'])->nullable();
            $table->boolean('nutrition_education')->default(0);
            $table->boolean('nutrition_counseling')->default(0);
            $table->text('discussion')->nullable();
            $table->boolean('receive_iron_folic')->default(0);
            $table->enum('discharge_criteria_exit', ['Cured PLW to BSFP','Cured Other', 'Death', 'Defaulted', 'Child become 6 Month Old'])->nullable();
            $table->enum('discharge_criteria_transfer_out', [ 'Transfer to other TSFP'])->nullable();
            $table->enum('discharge_criteria_others', ['Unexpected discontinuation of pregnancy','Others', 'Unknown'])->nullable();

            $table->float('wsb_plus_kg')->nullable();
            $table->float('oil_kg')->nullable();
            $table->float('others')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('pregnant_women_followups', function (Blueprint $table) {
            $table->dropColumn('new_admission');
            $table->dropColumn('readmission');
            $table->dropColumn('transfer_in_from');
            $table->dropColumn('referred_from');
            $table->dropColumn('outcome');
            $table->dropColumn('next_visit_date');
            $table->dropColumn('planed_date');
            $table->dropColumn('actual_date');
            $table->dropColumn('nutritionstatus');
            $table->dropColumn('nutrition_education');
            $table->dropColumn('nutrition_counseling');
            $table->dropColumn('discussion');
            $table->dropColumn('receive_iron_folic');
            $table->dropColumn('discharge_criteria_exit');
            $table->dropColumn('discharge_criteria_transfer_out');
            $table->dropColumn('discharge_criteria_others');
            $table->dropColumn('wsb_plus_kg');
            $table->dropColumn('oil_kg');
            $table->dropColumn('others');
        });
    }
}
