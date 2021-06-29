<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateChildrenPregnantWomensTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('children_pregnant_womens', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->BigInteger('child_sync_id')->unsigned();
            $table->foreign('child_sync_id')->references('sync_id')->on('children')
                ->onUpdate('cascade')->onDelete('cascade');
            $table->BigInteger('pregnant_women_sync_id')->unsigned();
            $table->foreign('pregnant_women_sync_id')->references('sync_id')->on('pregnant_womens')
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
        Schema::dropIfExists('children_pregnant_womens');
    }
}
