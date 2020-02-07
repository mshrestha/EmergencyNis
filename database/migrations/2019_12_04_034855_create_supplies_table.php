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
//            $table->string('period');
//            $table->integer('year');
//            $table->integer('month');
            $table->string('programPartner')->nullable();
            $table->string('partner')->nullable();
            $table->string('campSettlement')->nullable();
            $table->string('siteName')->nullable();
            $table->string('facilityId')->nullable();
//            $table->string('reportMode')->nullable();
            $table->date('supply_date');
            $table->date('expire_date');
            $table->enum('supply_type', ['Received', 'Distribution', 'Damage']);
            $table->string('location')->nullable();
            $table->enum('supply_item', ['F75','F100','RUTF','RUSF','Albendazol','Amoxiciline','WSB+','WSB++','Oil','Others']);
            $table->float('quantity',8,2);
            $table->enum('unit', ['Pack','Kg','Liter' ]);
            $table->text('remarks')->nullable();
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
