<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateIycfGroupSessionBeneficiariesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('iycf_group_session_beneficiaries', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->bigInteger('iycf_group_session_id')->unsigned();
            $table->foreign('iycf_group_session_id')->references('id')->on('iycf_group_sessions')->onDelete('cascade');
            $table->text('name');
            $table->enum('target_group', ['Pregnant Women', 'CaregiversWith<6Children','CaregiversWith6-23Children','Grandmothers','Adolescents Girls','Father/Male','Others'])->nullable();
            $table->enum('sex', ['Male', 'Female'])->default('Male')->nullable();

//            $table->enum('type', ['6-23Months Children', '24-59Months Children', 'Pregnant Women', 'Lactating Women'])->nullable();
//            $table->enum('beneficiary_type', ['Beneficiary','Guardian', 'Guardian & Beneficiary'])->nullable();
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
        Schema::dropIfExists('iycf_group_session_beneficiaries');
    }
}
