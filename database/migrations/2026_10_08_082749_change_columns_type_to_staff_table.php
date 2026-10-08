<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Schema;

class ChangeColumnsTypeToStaffTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        DB::table('staff')->update(['edu_lvl'=>1,'level'=>1]);
        Schema::table('staff', function (Blueprint $table) {
            $table->integer('edu_lvl')->default(1)->change();
            $table->integer('level')->default(1)->change();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('staff', function (Blueprint $table) {
            $table->dropColumn('edu_lvl');
            $table->dropColumn('level');
        });
    }
}
