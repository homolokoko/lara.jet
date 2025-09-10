<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddColumnInspectorIdToTableMeasureAuditItems extends Migration
{
    public function up(): void
    {
        Schema::table('measure_audit_items', function (Blueprint $table) {
            $table->integer('inspector_id')->nullable()->after('id');
        });
    }

    public function down(): void
    {
        Schema::table('measure_audit_items', function (Blueprint $table) {
            //
            $table->dropColumn('inspector_id');
        });
    }
}
