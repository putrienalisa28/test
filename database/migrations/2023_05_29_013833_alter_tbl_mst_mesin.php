<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AlterTblMstMesin extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('tbl_mst_mesin', function (Blueprint $table) {
            $table->string('tbl_from_prk_server')->nullable();
            $table->string('tag')->nullable();
            $table->string('create_by')->nullable();
            $table->string('update_by')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('tbl_mst_mesin', function (Blueprint $table) {
            //
            $table->dropColumn('tbl_from_prk_server');
            $table->dropColumn('create_by');
            $table->dropColumn('update_by');
            $table->dropColumn('tag');
        });
    }
}
