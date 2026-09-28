<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class RenameColumnIsDamageToInspEndlineItemTable extends Migration
{
    public function up(): void
    {
        Schema::table('insp_endline_item', function (Blueprint $table) {
            $table->renameColumn('is_damage', 'is_acceptable');
        });
    }

    public function down(): void
    {
        Schema::table('insp_endline_item', function (Blueprint $table) {
            $table->renameColumn('is_acceptable', 'is_damage');
        });
    }
}
