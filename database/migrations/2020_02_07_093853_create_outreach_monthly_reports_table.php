<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateOutreachMonthlyReportsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('outreach_monthly_reports', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->bigInteger('sync_id')->unique()->unsigned();
            $table->enum('sync_status', ['created', 'updated', 'synced'])->default('synced');
            $table->bigInteger('supervisor_id')->unsigned();
            $table->foreign('supervisor_id')->references('sync_id')->on('outreach_supervisors')->onDelete('cascade');
            $table->integer('date_month');
            $table->integer('date_year');
            $table->integer('pregnant_women');
            $table->integer('zero_to_six_months');
            $table->integer('six_to_twentyfour_months');
            $table->integer('grandmothers');
            $table->integer('adolescent');
            $table->integer('referral');
            $table->bigInteger('camp_id')->unsigned();
            $table->foreign('camp_id')->references('id')->on('camps')->onDelete('cascade');
            $table->timestamps();
        });

        Schema::table('outreach_monthly_reports', function(Blueprint $table) {
            $table->unique('id');
            $table->dropPrimary('id');
            $table->primary('sync_id');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('outreach_monthly_reports');
    }
}
