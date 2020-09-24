<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreatePpSectorsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('pp_sectors', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->BigInteger('pp_id')->unsigned();
            $table->foreign('pp_id')->references('id')->on('pps')
                ->onUpdate('cascade')->onDelete('cascade');
            $table->BigInteger('sector_id')->unsigned();
            $table->foreign('sector_id')->references('id')->on('sectors')
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
        Schema::dropIfExists('pp_sectors');
    }
}
