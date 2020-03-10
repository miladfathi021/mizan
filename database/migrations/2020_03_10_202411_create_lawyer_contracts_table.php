<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateLawyerContractsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('lawyer_contracts', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->string('license_number');
            $table->unsignedBigInteger('national_no');
            $table->string('province');
            $table->string('city');
            $table->unsignedBigInteger('phone');
            $table->unsignedSmallInteger('lawyer_experience');
            $table->unsignedSmallInteger('internet_consultation');
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
        Schema::dropIfExists('lawyer_contracts');
    }
}
