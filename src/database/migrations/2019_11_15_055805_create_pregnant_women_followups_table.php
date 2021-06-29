<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreatePregnantWomenFollowupsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('pregnant_women_followups', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->bigInteger('sync_id')->unique()->unsigned();
            $table->enum('sync_status', ['created', 'updated', 'synced'])->default('synced');
            $table->bigInteger('pregnant_women_id')->unsigned();
            $table->foreign('pregnant_women_id')->references('sync_id')->on('pregnant_womens')->onDelete('cascade');
            $table->date('date')->nullable();
            $table->string('muac')->nullable();
            $table->string('weight')->nullable();
            $table->bigInteger('facility_id')->unsigned();
            $table->foreign('facility_id')->references('id')->on('facilities')->onDelete('cascade');
            $table->timestamps();
        });

        Schema::table('pregnant_women_followups', function(Blueprint $table) {
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
        Schema::dropIfExists('pregnant_women_followups');
    }
}
