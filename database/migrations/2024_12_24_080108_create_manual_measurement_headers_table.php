<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateManualMeasurementHeadersTable extends Migration
{
    public function up(): void
    {
        Schema::create('manual_measurement_headers', function (Blueprint $table) {
            $table->id();
            $table->integer('header_id');
            $table->boolean('is_pass');
            $table->timestamps();
            $table->softDeletes();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('manual_measurement_headers');
    }
}
