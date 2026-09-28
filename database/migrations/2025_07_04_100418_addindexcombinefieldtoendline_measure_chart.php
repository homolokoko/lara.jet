<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::table('endline_measure_chart', function (Blueprint $table) {
            $table->index(['inspection_measure_item_id', 'measure_profile_chart_id'], 'charts_lookup_index');
        });
    }

    public function down(): void
    {
        Schema::table('', function (Blueprint $table) {
           $table->dropIndex('charts_lookup_index');
        });
    }
};
