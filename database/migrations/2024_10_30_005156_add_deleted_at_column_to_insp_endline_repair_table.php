<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddDeletedAtColumnToInspEndlineRepairTable extends Migration
{
    public function up(): void
    {
        Schema::table('insp_endline_repair', function (Blueprint $table) {
            $table->softDeletes();
        });
    }

    public function down(): void
    {
        Schema::table('insp_endline_repair', function (Blueprint $table) {
            $table->softDeletes();
        });
    }
}
