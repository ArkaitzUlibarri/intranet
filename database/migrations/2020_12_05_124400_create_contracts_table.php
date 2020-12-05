<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateContractsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        /**
         * Tabla donde se registra el contrato del usuario
         */
        Schema::create('contracts', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('user_id');
            $table->foreign('user_id')->references('id')->on('users')->onDelete('cascade');
            $table->unsignedBigInteger('contract_type_id');
            $table->foreign('contract_type_id')->references('id')->on('contract_types')->onDelete('cascade');
            $table->timestamp('start_date');
            $table->timestamp('estimated_end_date')->nullable();
            $table->timestamp('end_date')->nullable();
//            $table->unsignedBigInteger('national_days_id');
//            $table->foreign('national_days_id')->references('id')->on('bank_holidays_codes')->onDelete('cascade');
//            $table->unsignedBigInteger('regional_days_id');
//            $table->foreign('regional_days_id')->references('id')->on('bank_holidays_codes')->onDelete('cascade');
//            $table->unsignedBigInteger('local_days_id');
//            $table->foreign('local_days_id')->references('id')->on('bank_holidays_codes')->onDelete('cascade');
            $table->unsignedTinyInteger('week_hours');
            $table->timestamps();
            $table->softDeletes();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('contracts');
    }
}
