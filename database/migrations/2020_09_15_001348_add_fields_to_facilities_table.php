<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AddFieldsToFacilitiesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('facilities', function (Blueprint $table) {
            $table->BigInteger('pp_id')->nullable()->unsigned();
            $table->foreign('pp_id')->references('id')->on('pps')
                ->onUpdate('cascade')->onDelete('cascade');

            $table->BigInteger('ip_id')->nullable()->unsigned();
            $table->foreign('ip_id')->references('id')->on('ips')
                ->onUpdate('cascade')->onDelete('cascade');

        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('facilities', function (Blueprint $table) {
            $table->dropColumn('pp_id');
            $table->dropColumn('ip_id');

        });
    }
}
