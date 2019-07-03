<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateCommunityFollowupsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('community_followups', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->bigInteger('children_id')->unsigned();
            $table->foreign('children_id')->references('id')->on('children')->onDelete('cascade');
            $table->date('date')->nullable();
            $table->date('next_visit_date')->nullable();
            $table->integer('age');
            $table->boolean('exclusive_breastfeeding')->default(0);
            $table->boolean('continued_breastfeeding')->default(0);
            $table->enum('introduction_time', ['6_months', 'less_than_6_months', 'more_than_6_months']);
            $table->enum('frequency', ['less_than_2', '2', '3', 'more_than_3']);
            $table->enum('no_of_food_groups', ['4', 'more_than_4', 'less_than_4']);
            $table->enum('quantity_of_food', ['<125ml', '=>125 ml', '>125ml to <250ml', '=>250ml']);
            $table->boolean('received_all_epi_vaccination')->default(0);
            $table->double('muac')->nullable();
            $table->boolean('edema')->default(0);
            $table->enum('nutritional_status', ['Normal (MAUC =>13.5cm)', 'At Risk (12.5 to <13.5cm)', 'MAM (11.5 to <12.5cm)', 'SAM (<11.5cm)']);
            $table->enum('refered_to_facility', ['bsfp', 'otp', 'tsfp']);
            $table->bigInteger('facility_id')->unsigned();
            $table->foreign('facility_id')->references('id')->on('facilities')->onDelete('cascade');
            $table->string('referel_slip_no');
            $table->string('distribution_mnp_sachet');
            $table->string('vitamin_a');
            $table->string('deworming');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('community_followups');
    }
}
