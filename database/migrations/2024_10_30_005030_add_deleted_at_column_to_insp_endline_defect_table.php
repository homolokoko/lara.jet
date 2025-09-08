<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddDeletedAtColumnToInspEndlineDefectTable extends Migration
{
    public function up(): void
    {
        Schema::table('insp_endline_defect', function (Blueprint $table) {
            $table->softDeletes();
        });
    }

    public function down(): void
    {
        Schema::table('insp_endline_defect', function (Blueprint $table) {
            $table->softDeletes();
        });
    }
}
