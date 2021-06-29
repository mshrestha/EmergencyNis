<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateIpPpsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('ip_pps', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->BigInteger('pp_id')->unsigned();
            $table->foreign('pp_id')->references('id')->on('pps')
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
        Schema::dropIfExists('ip_pps');
    }
}
