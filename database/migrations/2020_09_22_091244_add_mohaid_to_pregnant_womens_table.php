<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AddMohaidToPregnantWomensTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('pregnant_womens', function (Blueprint $table) {
            $table->string('moha_id')->nullable();
            $table->string('progress_id')->nullable();
            $table->string('family_count_no')->nullable();
            $table->string('scope_no')->nullable();
            $table->string('sub_block_no')->nullable();
            $table->string('gps_coordinates_lat')->nullable();
            $table->string('gps_coordinates_lng')->nullable();
            $table->string('anc_pnc_card_no')->nullable();


        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('pregnant_womens', function (Blueprint $table) {
            $table->dropColumn('moha_id');
            $table->dropColumn('progress_id');
            $table->dropColumn('family_count_no');
            $table->dropColumn('scope_no');
            $table->dropColumn('sub_block_no');
            $table->dropColumn('gps_coordinates_lat');
            $table->dropColumn('gps_coordinates_lng');
            $table->dropColumn('anc_pnc_card_no');
        });
    }
}
