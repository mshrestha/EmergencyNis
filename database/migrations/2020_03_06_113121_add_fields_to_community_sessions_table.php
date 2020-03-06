<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AddFieldsToCommunitySessionsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('community_sessions', function (Blueprint $table) {
            $table->double('tot_scr_6_23_m')->default(0);
            $table->double('tot_scr_6_23_f')->default(0);
            $table->double('tot_scr_24_59_m')->default(0);
            $table->double('tot_scr_24_59_f')->default(0);
            $table->double('sam_ip_6_23_m')->default(0);
            $table->double('sam_ip_6_23_f')->default(0);
            $table->double('sam_ip_24_59_m')->default(0);
            $table->double('sam_ip_24_59_f')->default(0);
            $table->double('sam_ref_6_23_m')->default(0);
            $table->double('sam_ref_6_23_f')->default(0);
            $table->double('sam_ref_24_59_m')->default(0);
            $table->double('sam_ref_24_59_f')->default(0);
            $table->double('mam_ip_6_23_m')->default(0);
            $table->double('mam_ip_6_23_f')->default(0);
            $table->double('mam_ip_24_59_m')->default(0);
            $table->double('mam_ip_24_59_f')->default(0);
            $table->double('mam_ref_6_23_m')->default(0);
            $table->double('mam_ref_6_23_f')->default(0);
            $table->double('mam_ref_24_59_m')->default(0);
            $table->double('mam_ref_24_59_f')->default(0);
            $table->double('at_risk_6_23_m')->default(0);
            $table->double('at_risk_6_23_f')->default(0);
            $table->double('at_risk_24_59_m')->default(0);
            $table->double('at_risk_24_59_f')->default(0);
            $table->double('referred_m')->default(0);
            $table->double('referred_f')->default(0);
            $table->string('household_no')->nullable();
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
            $table->dropColumn('tot_scr_6_23_m');
            $table->dropColumn('tot_scr_6_23_f');
            $table->dropColumn('tot_scr_24_59_m');
            $table->dropColumn('tot_scr_24_59_f');
            $table->dropColumn('sam_ip_6_23_m');
            $table->dropColumn('sam_ip_6_23_f');
            $table->dropColumn('sam_ip_24_59_m');
            $table->dropColumn('sam_ip_24_59_f');
            $table->dropColumn('sam_ref_6_23_m');
            $table->dropColumn('sam_ref_6_23_f');
            $table->dropColumn('sam_ref_24_59_m');
            $table->dropColumn('sam_ref_24_59_f');
            $table->dropColumn('mam_ip_6_23_m');
            $table->dropColumn('mam_ip_6_23_f');
            $table->dropColumn('mam_ip_24_59_m');
            $table->dropColumn('mam_ip_24_59_f');
            $table->dropColumn('mam_ref_6_23_m');
            $table->dropColumn('mam_ref_6_23_f');
            $table->dropColumn('mam_ref_24_59_m');
            $table->dropColumn('mam_ref_24_59_f');
            $table->dropColumn('at_risk_6_23_m');
            $table->dropColumn('at_risk_6_23_f');
            $table->dropColumn('at_risk_24_59_m');
            $table->dropColumn('at_risk_24_59_f');
            $table->dropColumn('referred_m');
            $table->dropColumn('referred_f');
            $table->dropColumn('household_no');
        });
    }
}
