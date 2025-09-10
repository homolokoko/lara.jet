<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddDefectRecordIdDefaultValueToTableActionTakenEndlineHeader extends Migration
{
    public function up(): void
    {
        Schema::table('action_taken_endline_header', function (Blueprint $table) {
            $table->string('defect_record_id')->default(null)->change();
        });
    }

    public function down(): void
    {
        Schema::table('action_taken_endline_header', function (Blueprint $table) {
            //
            $table->string('defect_record_id')->default('')->change();
        });
    }
}
