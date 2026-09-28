<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddColumnDefectRecordToActionTakenEndlineMeasureHeader extends Migration
{
    public function up(): void
    {
        Schema::table('action_taken_endline_measure_header', function (Blueprint $table) {
            $tableName = 'action_taken_endline_measure_header';
            if (!Schema::hasColumn($tableName, 'defect_record_id')) {
                $table->integer('defect_record_id')->nullable()
                    ->comment('Defect Record ID from table endline_measure_defect_tracking');

            }
            if (!Schema::hasColumn($tableName, 'is_pending')) {
                $table->boolean('is_pending')->default(true)->after('defect_record_id')
                    ->comment('0 = action taken, 1 = pending action taken');
            }

            if (!Schema::hasColumn($tableName, 'is_resolved')) {
                $table->boolean('is_resolved')->default(false)->after('is_pending')
                    ->comment('0 = not resolved, 1 = resolved');
            }

            if (!Schema::hasColumn($tableName, 'locate_id')) {
                $table->integer('locate_id')->nullable()->after('is_resolved');
            }

        });
    }

    public function down(): void
    {
        Schema::table('action_taken_endline_measure_header', function (Blueprint $table) {
            //
            $table->dropColumn('defect_record_id');
            $table->dropColumn('is_pending');
            $table->dropColumn('is_resolved');
            $table->dropColumn('locate_id');
        });
    }
}
