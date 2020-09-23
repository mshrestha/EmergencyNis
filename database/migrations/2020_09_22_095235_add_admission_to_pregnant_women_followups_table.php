<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AddAdmissionToPregnantWomenFollowupsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('pregnant_women_followups', function (Blueprint $table) {
            $table->string('new_admission')->nullable();
            $table->string('readmission')->nullable();
            $table->string('transfer_in_from')->nullable();
            $table->string('referred_from')->nullable();
            $table->date('next_visit_date')->nullable();
            $table->date('planed_date')->nullable();
            $table->date('actual_date')->nullable();
            $table->enum('nutritionstatus', ['MAM', 'Normal'])->nullable();
            $table->boolean('nutrition_education')->default(0);
            $table->boolean('nutrition_counseling')->default(0);
            $table->text('discussion')->nullable();
            $table->boolean('receive_iron_folic')->default(0);
            $table->float('wsb_plus_plus_kg')->nullable();
            $table->float('wsb_plus_kg')->nullable();
            $table->float('oil_kg')->nullable();
            $table->float('others')->nullable();



        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('pregnant_women_followups', function (Blueprint $table) {
            //
        });
    }
}
