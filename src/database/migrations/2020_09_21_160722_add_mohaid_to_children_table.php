<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AddMohaidToChildrenTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('children', function (Blueprint $table) {
            $table->string('moha_id')->nullable();
            $table->string('progress_id')->nullable();
            $table->string('scope_no')->nullable();
            $table->string('block')->nullable();
            $table->enum('age_group', ['0to5m', '6to11m','11to23m','24to59m','60+'])->nullable();

        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('children', function (Blueprint $table) {
            $table->dropColumn('moha_id');
            $table->dropColumn('progress_id');
            $table->dropColumn('scope_no');
            $table->dropColumn('block');
            $table->dropColumn('age_group');

        });
    }
}
