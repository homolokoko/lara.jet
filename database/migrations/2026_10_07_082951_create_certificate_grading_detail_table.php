<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateCertificateGradingDetailTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('certificate_grading_detail', function (Blueprint $table) {
            $table->integer('student_id');
            $table->boolean('is_absent')->nullable();
            $table->foreignId('header_id')->constrained('certificate_grading_header')->cascadeOnDelete();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('certificate_grading_detail');
    }
}
