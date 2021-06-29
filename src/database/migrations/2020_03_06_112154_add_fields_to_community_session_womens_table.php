<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AddFieldsToCommunitySessionWomensTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('community_session_womens', function (Blueprint $table) {
            $table->double('household_no')->nullable();
            $table->double('mam_inprogress_preg')->default(0);
            $table->double('mam_inprogress_lac')->default(0);
            $table->double('mam_referred_preg')->default(0);
            $table->double('mam_referred_lac')->default(0);
            $table->double('normal_preg')->default(0);
            $table->double('normal_lac')->default(0);
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
            $table->dropColumn('household_no');
            $table->dropColumn('mam_inprogress_preg');
            $table->dropColumn('mam_inprogress_lac');
            $table->dropColumn('mam_referred_preg');
            $table->dropColumn('mam_referred_lac');
            $table->dropColumn('normal_preg');
            $table->dropColumn('normal_lac');
        });
    }
}
