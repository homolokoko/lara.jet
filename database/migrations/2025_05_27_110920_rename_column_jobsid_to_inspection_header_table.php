<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class RenameColumnJobsidToInspectionHeaderTable extends Migration
{
    public function up(): void
    {
        Schema::table('inspection_header', function (Blueprint $table) {
            $table->renameColumn('jobId', 'jobs_id');
        });
    }

    public function down(): void
    {
        Schema::table('inspection_header', function (Blueprint $table) {
            $table->renameColumn('jobs_id', 'jobId');
        });
    }
}
