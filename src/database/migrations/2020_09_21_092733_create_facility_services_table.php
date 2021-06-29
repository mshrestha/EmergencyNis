<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateFacilityServicesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('facility_services', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->BigInteger('facility_id')->unsigned();
            $table->foreign('facility_id')->references('id')->on('facilities')
                ->onUpdate('cascade')->onDelete('cascade');
            $table->BigInteger('service_id')->unsigned();
            $table->foreign('service_id')->references('id')->on('services')
                ->onUpdate('cascade')->onDelete('cascade');

//            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('facility_services');
    }
}
