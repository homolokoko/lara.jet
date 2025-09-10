<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateManualMeasurementBuyerTitlesTable extends Migration
{
    public function up(): void
    {
        Schema::create('manual_measurement_buyer_titles', function (Blueprint $table) {
            $table->id();
            $table->integer('titles_id');
            $table->integer('buyers_id');
            $table->timestamps();
            $table->softDeletes();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('manual_measurement_buyer_titles');
    }
}
