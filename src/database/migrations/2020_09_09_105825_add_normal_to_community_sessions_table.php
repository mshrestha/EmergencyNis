<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AddNormalToCommunitySessionsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('community_sessions', function (Blueprint $table) {
            $table->double('normal_6_23_m')->default(0);
            $table->double('normal_6_23_f')->default(0);
            $table->double('normal_24_59_m')->default(0);
            $table->double('normal_24_59_f')->default(0);

        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('community_sessions', function (Blueprint $table) {
            $table->dropColumn('normal_6_23_m');
            $table->dropColumn('normal_6_23_f');
            $table->dropColumn('normal_24_59_m');
            $table->dropColumn('normal_24_59_f');

        });
    }
}
