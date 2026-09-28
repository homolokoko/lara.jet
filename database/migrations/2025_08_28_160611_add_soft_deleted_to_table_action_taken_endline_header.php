<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddSoftDeletedToTableActionTakenEndlineHeader extends Migration
{
    public function up(): void
    {
        Schema::table('action_taken_endline_header', function (Blueprint $table) {
            $table->softDeletes();
        });
    }

    public function down(): void
    {
        Schema::table('action_taken_endline_header', function (Blueprint $table) {
            //
            $table->dropSoftDeletes();
        });
    }
}
