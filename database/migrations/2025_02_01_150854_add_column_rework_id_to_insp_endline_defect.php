<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddColumnReworkIdToInspEndlineDefect extends Migration
{
    public function up(): void
    {
        Schema::table('insp_endline_defect', function (Blueprint $table) {
            $table->unsignedBigInteger('rework_id')->nullable();
        });
    }

    public function down(): void
    {
        Schema::table('insp_endline_defect', function (Blueprint $table) {
            $table->dropColumn('rework_id');
        });
    }
}
