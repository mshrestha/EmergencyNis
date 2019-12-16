<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateSuppliesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('supplies', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('period');
            $table->integer('year');
            $table->integer('month');
            $table->string('programPartner')->nullable();
            $table->string('partner')->nullable();
            $table->string('campSettlement')->nullable();
            $table->string('siteName')->nullable();
            $table->string('facilityId')->nullable();
            $table->string('reportMode')->nullable();

            $table->enum('supply', ['F75', 'F100', 'RUTF', 'Albendazol', 'Amoxiciline']);
            $table->integer('remainingFromLastMonth');
            $table->integer('received');
            $table->integer('consumed');
            $table->integer('damaged');
            $table->integer('balance');
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
        Schema::dropIfExists('supplies');
    }
}
