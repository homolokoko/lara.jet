<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::table('report_endline_measure_tol', function (Blueprint $table) {
            $table->index(['report_date', 'measure_profile_detail', 'locate', 'version'], 'mt_lookup_index');
        });
    }

    public function down(): void
    {
        Schema::table('report_endline_measure_tol', function (Blueprint $table) {
            $table->dropIndex('mt_lookup_index');
        });
    }
};
