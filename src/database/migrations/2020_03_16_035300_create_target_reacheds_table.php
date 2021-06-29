<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateTargetReachedsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('target_reacheds', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('indicator_id')->unsigned();
            $table->foreign('indicator_id')
                ->references('id')->on('indicators')
                ->onDelete('cascade');


            $table->float('in_need',10,2)->default(0);
            $table->float('baseline',10,2)->default(0);
            $table->float('target',10,2)->default(0);
            $table->float('reached',10,2)->default(0);
            $table->year('data_year');
            $table->text('comments')->nullable();
            $table->enum('use_this',['Use this reached data','Use system generated reached data'])->default('Use this reached data');

            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('target_reacheds');
    }
}
