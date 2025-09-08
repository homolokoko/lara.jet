<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class ChangeColumnLabelprintmarkTitleToInspectionLabelprintmakLocations extends Migration
{
    public function up(): void
    {
        Schema::table('inspeciton_labelprintmark_locations', function (Blueprint $table) {
            $table->renameColumn('name', 'labelprintmark_title_id');
            $table->renameColumn('inspeciton_labelprintmark_id', 'inspection_labelprintmark_id');
        });
    }

    public function down(): void
    {
        Schema::table('inspeciton_labelprintmark_locations', function (Blueprint $table) {
            $table->renameColumn('labelprintmark_title_id', 'name');
            $table->renameColumn('inspection_labelprintmark_id', 'inspeciton_labelprintmark_id');
        });
    }
}
