<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AddPqiDefectTypeIdToPqiDefect extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('pqi_defect', function (Blueprint $table) {
            $table->integer('pqi_defect_type_id')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('pqi_defect', function (Blueprint $table) {
            $table->dropColumn('pqi_defect_type_id');
        });
    }
}
