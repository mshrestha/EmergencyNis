<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AddGeneralinfoToFacilityFollowupsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('facility_followups', function (Blueprint $table) {
            $table->enum('continued_breastfeeding', ['Yes', 'No','N/A'])->nullable();
            $table->boolean('received_all_epi_vaccination')->default(0);
            $table->string('complementary_feeding_frequency')->nullable();
            $table->integer('complementary_feeding_introduction_time')->nullable();
            $table->string('complementary_feeding_foodtype')->nullable();
            $table->string('outcome')->nullable();

        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('facility_followups', function (Blueprint $table) {
            $table->dropColumn('continued_breastfeeding');
            $table->dropColumn('received_all_epi_vaccination');
            $table->dropColumn('complementary_feeding_frequency');
            $table->dropColumn('complementary_feeding_introduction_time');
            $table->dropColumn('complementary_feeding_foodtype');
            $table->dropColumn('outcome');
        });
    }
}
