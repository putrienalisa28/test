<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class TbTrnPmDtl extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('tb_trn_pm_dtl', function (Blueprint $table) {
            $table->id();
            $table->integer('hdr_id');
            $table->string('indication');
            $table->string('problem_solv');
            $table->string('checking_result');
            $table->boolean('maintenance_status');
            $table->string('remarks');
            $table->boolean('approval_status');
            $table->date('approval_date');
            $table->string('approval_by');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('tb_trn_pm_dtl');
    }
}
