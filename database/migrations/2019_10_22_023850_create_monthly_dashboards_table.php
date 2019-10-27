<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateMonthlyDashboardsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('monthly_dashboards', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->integer('month');
            $table->integer('year');
            $table->string('period');
//dashboard manager
            $table->bigInteger('facility_id')->unsigned();
            $table->foreign('facility_id')->references('id')->on('facilities')->onDelete('cascade');
            $table->integer('otp_admit_23m')->default(0);
            $table->integer('otp_admit_24m')->default(0);
            $table->integer('otp_admit_60m')->default(0);
            $table->integer('otp_admit_23f')->default(0);
            $table->integer('otp_admit_24f')->default(0);
            $table->integer('otp_admit_60f')->default(0);
            $table->integer('otp_admit_male')->default(0);
            $table->integer('otp_admit_female')->default(0);
            $table->integer('otp_admit_others')->default(0);
            $table->integer('otp_admit_muac')->default(0);
            $table->integer('otp_admit_whz')->default(0);
            $table->integer('otp_admit_both')->default(0);
//dashboard common
            $table->integer('total_admit')->default(0);
            $table->decimal('cure_rate',5,2)->default(0.00);
            $table->decimal('death_rate',5,2)->default(0.00);
            $table->decimal('default_rate',5,2)->default(0.00);
            $table->decimal('nonrespondent_rate',5,2)->default(0.00);
            $table->decimal('avg_weight_gain',5,2)->default(0.00);
            $table->decimal('avg_length_stay',5,2)->default(0.00);
//otp report
            $table->integer('otp_mnthend_23m')->default(0);
            $table->integer('otp_mnthend_24m')->default(0);
            $table->integer('otp_mnthend_60m')->default(0);
            $table->integer('otp_mnthend_23f')->default(0);
            $table->integer('otp_mnthend_24f')->default(0);
            $table->integer('otp_mnthend_60f')->default(0);

//            $table->integer('created_by');
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
        Schema::dropIfExists('monthly_dashboards');
    }
}
