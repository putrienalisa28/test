<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class TbTrnPmHdr extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('tb_trn_pm_hdr', function (Blueprint $table) {
            $table->id();
            $table->timestamps();
            $table->integer('sparepart_id');
            $table->integer('machine_id');
            $table->integer('last_interval');
            $table->integer('next_interval_estimate');
            $table->integer('last_maintenance');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('tb_trn_pm_hdr');
    }
}
