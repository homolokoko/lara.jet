<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up(): void
    {
        DB::table('endline_measure_chart')
            ->where('different', '=', '')
            ->update(['different' => 0]);

        Schema::table('endline_measure_chart', function (Blueprint $table) {
            $table->float('different', 10, 5)->change();
            $table->index('different');
        });
    }

    public function down(): void
    {
        Schema::table('endline_measure_chart', function (Blueprint $table) {
            $table->string('different')->change();
            $table->dropIndex('different');
        });
    }
};
