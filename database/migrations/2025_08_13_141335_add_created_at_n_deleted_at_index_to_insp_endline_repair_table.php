<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddCreatedAtNDeletedAtIndexToInspEndlineRepairTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('insp_endline_repair', function (Blueprint $table) {
            //
            $table->index(['created_at', 'deleted_at'], 'idx_insp_endline_repair_created_deleted');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('insp_endline_repair', function (Blueprint $table) {
            //
            $table->dropIndex('idx_insp_endline_repair_created_deleted');
        });
    }
}
