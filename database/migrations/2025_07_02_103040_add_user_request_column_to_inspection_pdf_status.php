<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddUserRequestColumnToInspectionPdfStatus extends Migration
{
    public function up(): void
    {
        Schema::table('inspection_pdf_status', function (Blueprint $table) {
            $table->integer('user_request')->nullable()->after('id');
            $table->string('cloud_file')->nullable()->after('user_request');
        });
    }

    public function down(): void
    {
        Schema::table('inspection_pdf_status', function (Blueprint $table) {
            //
            $table->dropColumn('user_request');
            $table->dropColumn('cloud_file');
        });
    }
}
