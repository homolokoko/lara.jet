<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateInspectionMeasureOotRecordsTable extends Migration
{
    public function up(): void
    {
        Schema::create('inspection_measure_oot_records', function (Blueprint $table) {
            $table->id();
            $table->integer('header_id');
            $table->integer('point_of_measurement_id');
            $table->integer('color_id');
            $table->string('oot');
            $table->integer('pc');
            $table->timestamps();
            $table->softDeletes();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('inspection_measure_oot_records');
    }
}
