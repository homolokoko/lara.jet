<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddColumnReworkToInspEndlineItem extends Migration
{
    public function up(): void
    {
        Schema::table('insp_endline_item', function (Blueprint $table) {
            $table->unsignedBigInteger('rework_qty')->default(0);
        });
    }

    public function down(): void
    {
        Schema::table('insp_endline_item', function (Blueprint $table) {
            //
            $table->dropColumn('rework_qty');
        });
    }
}
