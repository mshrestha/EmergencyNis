<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateCampIpsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('camp_ips', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->BigInteger('camp_id')->unsigned();
            $table->foreign('camp_id')->references('id')->on('camps')
                ->onUpdate('cascade')->onDelete('cascade');
            $table->BigInteger('ip_id')->unsigned();
            $table->foreign('ip_id')->references('id')->on('ips')
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
        Schema::dropIfExists('camp_ips');
    }
}
