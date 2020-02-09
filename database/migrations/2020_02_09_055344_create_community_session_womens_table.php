<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateCommunitySessionWomensTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('community_session_womens', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->bigInteger('sync_id')->unique()->unsigned();
            $table->enum('sync_status', ['created', 'updated', 'synced'])->default('synced');
            $table->bigInteger('volunteer_id')->unsigned();
            $table->foreign('volunteer_id')->references('sync_id')->on('volunteers')->onDelete('cascade');
            $table->integer('screened')->default(0);
            $table->integer('referred')->default(0);
            $table->integer('inprogram')->default(0);
            $table->integer('sam')->default(0);
            $table->integer('mam')->default(0);
            $table->date('date');
            $table->timestamps();
        });

        Schema::table('community_session_womens', function(Blueprint $table) {
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
        Schema::dropIfExists('community_session_womens');
    }
}
