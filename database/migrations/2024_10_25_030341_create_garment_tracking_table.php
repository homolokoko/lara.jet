<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateGarmentTrackingTable extends Migration
{
    public function up(): void
    {
        Schema::create('garment_tracking', function (Blueprint $table) {
            $table->id()->autoIncrement();
            $table->longText('garmentQrCode')->comment('eg: IA14576-118-A-4520-1');
            $table->char('module', 255)->comment('endline/afterWash/recovery');
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('garment_tracking');
    }
}
