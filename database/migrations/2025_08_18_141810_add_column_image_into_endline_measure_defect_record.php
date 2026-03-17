<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddColumnImageIntoEndlineMeasureDefectRecord extends Migration
{
    public function up(): void
    {
        Schema::table('endline_measure_defect_record', function (Blueprint $table) {
            $table->string('image')->nullable();
        });
    }

    public function down(): void
    {
        Schema::table('endline_measure_defect_record', function (Blueprint $table) {
            //
            $table->dropColumn('image');
        });
    }
}
