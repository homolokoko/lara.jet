<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddColumnColspanToInspectionPhotographDetailTable extends Migration
{
    public function up(): void
    {
        Schema::table('inspection_photograph_detail', function (Blueprint $table) {
            $table->integer('colspan', false, true)->length(1)->default(1);
        });
    }

    public function down(): void
    {
        Schema::table('inspection_photograph_detail', function (Blueprint $table) {
            $table->dropColumn('colspan');
        });
    }
}
