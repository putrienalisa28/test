<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AlterUserTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('users', function (Blueprint $table) {
            $table
                ->boolean('is_active')
                ->unsigned()
                ->nullable()
                ->default(1)
                ->after('telegram_id');
            $table
                ->string('created_by')
                ->unsigned()
                ->nullable()
                ->after('created_at');
            $table
                ->string('updated_by')
                ->unsigned()
                ->nullable()
                ->after('updated_at');
            $table
                ->string('email')
                ->unsigned()
                ->nullable()
                ->after('updated_at');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('users', function (Blueprint $table) {
            $table->dropColumn('is_active');
            $table->dropColumn('created_by');
            $table->dropColumn('updated_by');
            $table->dropColumn('email');
        });
    }
}
