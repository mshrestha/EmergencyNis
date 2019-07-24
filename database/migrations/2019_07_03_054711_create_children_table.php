<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateChildrenTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('children', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('mnr_no')->nullable();
            $table->string('mrc_no')->nullable();
            $table->integer('camp_id')->unsigned()->nullable();
            $table->foreign('camp_id')->references('id')->on('camps')->onDelete('cascade');
            $table->date('date')->nullable();
            $table->string('sub_block_no')->nullable();
            $table->string('hh_no')->nullable();
            $table->string('gps_coordinates_lat')->nullable();
            $table->string('gps_coordinates_lng')->nullable();
            $table->string('family_count_no')->nullable();
            $table->text('mother_caregiver_name')->nullable();
            $table->text('fathers_name')->nullable();
            $table->text('block_leader_name')->nullable();
            $table->text('children_name')->nullable();
            $table->date('date_of_birth')->nullable();
            $table->integer('age')->nullable();
            $table->enum('sex', ['male', 'female'])->default('male')->nullable();
            $table->string('phone')->nullable();
            $table->text('picture')->nullable();
            $table->text('barcode')->nullable();
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
        Schema::dropIfExists('children');
    }
}
