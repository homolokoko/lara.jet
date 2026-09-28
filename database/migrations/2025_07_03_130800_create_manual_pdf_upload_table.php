<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateManualPdfUploadTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('manual_pdf_upload', function (Blueprint $table) {
            $table->id();
            $table->longText('jobs_id');
            $table->integer('profile_id');
            $table->longText('file_name')->nullable();
            $table->longText('local_path')->nullable();
            $table->longText('cloud_path')->nullable();
            $table->integer('upload_status')->default(-1);
            $table->text('error_message')->nullable();
            $table->timestamp('uploaded_at')->nullable();
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
        Schema::dropIfExists('manual_pdf_upload');
    }
}
