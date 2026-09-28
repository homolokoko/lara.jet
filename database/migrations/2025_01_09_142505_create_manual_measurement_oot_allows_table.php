<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateManualMeasurementOotAllowsTable extends Migration
{
    public function up(): void
    {
        Schema::create('manual_measurement_oot_allows', function (Blueprint $table) {
            $table->id();
            $table->integer('point');
            $table->string('header_id');
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('manual_measurement_oot_allows');
    }
}
