<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateGarmentTrackingEndline extends Migration
{
    public function up(): void
    {
        Schema::create('garment_tracking_endline', function (Blueprint $table) {
            $table->id()->autoIncrement();
            $table->unsignedBigInteger('garment_tracking_id');
            $table->unsignedBigInteger('insp_endline_item_id');
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('garment_tracking_endline');
    }
}
