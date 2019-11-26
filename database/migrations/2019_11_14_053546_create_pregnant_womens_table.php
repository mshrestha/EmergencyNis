<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreatePregnantWomensTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('pregnant_womens', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->bigInteger('sync_id')->unique()->unsigned();
            $table->enum('sync_status', ['created', 'updated', 'synced'])->default('synced');
            $table->enum('type', ['pregnant', 'lactating'])->default('pregnant');
            $table->string('registration_id')->nullable();
            $table->bigInteger('camp_id')->unsigned();
            $table->foreign('camp_id')->references('id')->on('camps')->onDelete('cascade');
            $table->string('block_no')->nullable();
            $table->string('household_no')->nullable();
            $table->string('pregnant_women_name')->nullable();
            $table->string('husbands_name')->nullable();
            $table->string('fathers_name')->nullable();
            $table->integer('age')->nullable();
            $table->integer('pregnancy_month')->nullable();
            $table->date('expected_delivery_date')->nullable();
            $table->date('actual_date_of_delivery')->nullable();
            $table->string('new_admission')->nullable();
            $table->string('readmission')->nullable();
            $table->string('transfer_in_from')->nullable();
            $table->string('referred_from')->nullable();
            $table->date('next_visit_date')->nullable();
            $table->bigInteger('facility_id')->unsigned();
            $table->foreign('facility_id')->references('id')->on('facilities')->onDelete('cascade');
            $table->timestamps();
        });

        Schema::table('pregnant_womens', function(Blueprint $table) {
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
        Schema::dropIfExists('pregnant_womens');
    }
}
