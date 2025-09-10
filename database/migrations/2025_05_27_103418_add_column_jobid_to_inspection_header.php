<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddColumnJobidToInspectionHeader extends Migration
{
    public function up(): void
    {
        Schema::table('inspection_header', function (Blueprint $table) {
            $table->text('jobId')->after('inspector_id')->nullable();
        });
    }

    public function down(): void
    {
        Schema::table('inspection_header', function (Blueprint $table) {
            //
            $table->dropColumn('jobId');
        });
    }
}
