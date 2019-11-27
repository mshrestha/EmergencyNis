<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateIycfFollowupsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('iycf_followups', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->bigInteger('sync_id')->unique()->unsigned();
            $table->enum('sync_status', ['created', 'updated', 'synced'])->default('synced');
            $table->bigInteger('children_id')->unsigned();
            $table->foreign('children_id')->references('sync_id')->on('children')->onDelete('cascade');
            $table->bigInteger('facility_id')->unsigned();
            $table->foreign('facility_id')->references('id')->on('facilities')->onDelete('cascade');
            $table->date('date')->nullable();
            $table->tinyInteger('underwent_full_iycf_assesment')->nullable();
            $table->string('type_of_feeding')->nullable();
            $table->tinyInteger('breastfeeding_support')->default(0);
            $table->tinyInteger('relactation_support')->default(0);
            $table->tinyInteger('wet_nursing_support')->default(0);
            $table->tinyInteger('complementary_feeding_advice')->default(0);
            $table->tinyInteger('psycho_social_support')->default(0);
            $table->tinyInteger('other')->default(0);
            $table->timestamps();
        });

        Schema::table('iycf_followups', function(Blueprint $table) {
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
        Schema::dropIfExists('iycf_followups');
    }
}
