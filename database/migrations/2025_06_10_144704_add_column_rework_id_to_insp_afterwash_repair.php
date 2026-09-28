<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddColumnReworkIdToInspAfterwashRepair extends Migration
{
    public function up(): void
    {
        Schema::table('insp_afterwash_repair', function (Blueprint $table) {
            $table->integer('rework_id')->nullable()->after('id');
        });
    }

    public function down(): void
    {
        Schema::table('insp_afterwash_repair', function (Blueprint $table) {
            //
            $table->dropColumn('rework_id');
        });
    }
}
