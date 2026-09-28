<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateGarmentTrackingTransactionsTable extends Migration
{
    public function up(): void
    {
        Schema::create('garment_tracking_transactions', function (Blueprint $table) {
            $table->id();
            $table->string('module');
            $table->integer('garment_tracking_id');
            $table->boolean('is_pass');
            $table->timestamps();
            $table->softDeletes();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('garment_tracking_transactions');
    }
}
