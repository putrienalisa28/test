<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class TblTrnPmImageDetail extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('tbl_trn_pm_image_detail', function (Blueprint $table) {
            $table->id();
            $table->timestamps();
            $table->integer('dtl_id');
            $table->string('image_path');
            $table->string('image_description');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('tbl_trn_pm_image_detail');
    }
}
