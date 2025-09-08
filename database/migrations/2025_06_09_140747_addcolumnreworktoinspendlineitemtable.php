<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
return new class extends Migration{
    public function up(): void
    {
        if ( ! Schema::hasColumn('insp_afterwash_item', 'rework_qty')) {
            Schema::table('insp_afterwash_item', function (Blueprint $table) {
                $table->unsignedBigInteger('rework_qty')->default(0);
            });
        }
        if(Schema::hasColumn('insp_afterwash_item', 'is_damage')){
            Schema::table('insp_afterwash_item', function (Blueprint $table) {
                $table->renameColumn('is_damage', 'is_acceptable');
            });
        }
    }

    public function down(): void
    {
        if (Schema::hasColumn('insp_afterwash_item', 'rework_qty')) {
            Schema::table('insp_afterwash_item', function (Blueprint $table) {
                $table->unsignedBigInteger('rework_qty')->default(0);
            });
        }


        if(Schema::hasColumn('insp_afterwash_item', 'is_acceptable')){
            Schema::table('insp_afterwash_item', function (Blueprint $table) {
                $table->renameColumn('is_acceptable', 'is_damage');
            });
        }

    }
};
