<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddUploadStatusToInspectionPdfStatusTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('inspection_pdf_status', function (Blueprint $table) {
            //
            $table->integer('upload_status')->default(-1);
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('inspection_pdf_status', function (Blueprint $table) {
            //
            $table->dropColumn('upload_status');
        });
    }
}
