<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AddFacilityIdToCommunitySessionWomensTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('community_session_womens', function (Blueprint $table) {
            $table->integer('facility_id')->nullable();

        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('community_session_womens', function (Blueprint $table) {
            $table->dropColumn('facility_id');
        });
    }
}
