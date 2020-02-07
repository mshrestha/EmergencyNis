<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateSupervisorsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('outreach_supervisors', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->bigInteger('sync_id')->unique()->unsigned();
            $table->enum('sync_status', ['created', 'updated', 'synced'])->default('synced');
            $table->bigInteger('camp_id')->unsigned()->nullable();
            $table->foreign('camp_id')->references('id')->on('camps')->onDelete('cascade');
            $table->string('name');
            $table->timestamps();
        });

        Schema::table('outreach_supervisors', function(Blueprint $table) {
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
        Schema::dropIfExists('outreach_supervisors');
    }
}
