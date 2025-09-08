<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateEndlineMeasureDefectTrackingsTable extends Migration
{
    public function up(): void
    {
        Schema::create('endline_measure_defect_tracking', function (Blueprint $table) {
            $table->id();
            $table->integer('measure_defect_record_id')->comment('Measure Defect Record ID');
            $table->string('qrcode')->comment('Garment QR Code');
            $table->integer('founded_by')->comment('User ID');
            $table->dateTime('founded_at');
            $table->integer('return_by')->nullable()->comment('User ID');
            $table->dateTime('return_at')->nullable();
            $table->integer('is_active')->default(1)->comment('1 = Active, 0 = Inactive');
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('endline_measure_defect_tracking');
    }
}
