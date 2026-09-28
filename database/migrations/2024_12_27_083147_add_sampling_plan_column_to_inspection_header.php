<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddSamplingPlanColumnToInspectionHeader extends Migration
{
    public function up(): void
    {
        Schema::table('inspection_header', function (Blueprint $table) {
            $table->string('sampling_plan')->nullable();
        });
    }

    public function down(): void
    {
        Schema::table('inspection_header', function (Blueprint $table) {
            $table->dropColumn('sampling_plan');
        });
    }
}
