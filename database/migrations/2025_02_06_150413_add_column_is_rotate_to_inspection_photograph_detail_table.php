<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddColumnIsRotateToInspectionPhotographDetailTable extends Migration
{
    public function up(): void
    {
        Schema::table('inspection_photograph_detail', function (Blueprint $table) {
            $table->boolean('is_rotate')->default(false);
        });
    }

    public function down(): void
    {
        Schema::table('inspection_photograph_detail', function (Blueprint $table) {
            //
            $table->dropColumn('is_rotate');
        });
    }
}
