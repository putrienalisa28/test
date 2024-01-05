<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateSparepartModelsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('tbl_mst_sparepart', function (Blueprint $table) {
            $table->id();
            $table->string('item_id');
            $table->text('item_name');
            $table->string('doc_no');
            $table->bigint('work_time_m');
            $table->bigint('work_time_h');
            $table->string('spare_part_no');
            $table->json('tag');
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
        Schema::dropIfExists('tbl_mst_sparepart');
    }
}
