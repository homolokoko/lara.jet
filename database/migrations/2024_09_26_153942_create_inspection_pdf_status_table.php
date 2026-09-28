<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateInspectionPdfStatusTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('inspection_pdf_status', function (Blueprint $table) {
            $table->id()->autoIncrement();
            $table->longText('jobs_id');
            $table->longText('file_name')->nullable();
            $table->timestamp('execute_start')->nullable();
            $table->timestamp('execute_end')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('inspection_pdf_status');
    }
}
