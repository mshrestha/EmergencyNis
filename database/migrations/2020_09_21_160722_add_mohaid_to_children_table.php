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
            $table->string('block')->nullable();
            $table->enum('age_group', ['0to6m', '6to23m','24to59m','others'])->nullable();

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
            $table->dropColumn('block');
            $table->dropColumn('age_group');

        });
    }
}
