<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class ChangeTableInspecitonLabelprintmarkLocations extends Migration
{
    public function up(): void
    {
        Schema::rename('inspeciton_labelprintmark_locations', 'inspection_labelprintmark_locations');
    }

    public function down(): void
    {
        Schema::rename('inspection_labelprintmark_locations', 'inspeciton_labelprintmark_locations');
    }
}
