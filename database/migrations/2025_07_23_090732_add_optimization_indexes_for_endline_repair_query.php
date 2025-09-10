<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddOptimizationIndexesForEndlineRepairQuery extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        // Index for insp_endline_repair table
        Schema::table('insp_endline_repair', function (Blueprint $table) {
            $table->index(['created_at', 'deleted_at', 'insp_endline_item_id'], 'idx_repair_created_deleted');
        });

        // Index for workstation_locates table
        Schema::table('workstation_locates', function (Blueprint $table) {
            $table->index(['id', 'deleted_at'], 'idx_workstation_id_deleted');
        });

        // Index for insp_endline_profile table
        Schema::table('insp_endline_profile', function (Blueprint $table) {
            $table->index(['workstation_locates_id', 'deleted_at', 'id'], 'idx_profile_workstation_deleted');
        });

        // Index for insp_endline_item table
        Schema::table('insp_endline_item', function (Blueprint $table) {
            $table->index(['insp_endline_profile_id', 'id'], 'idx_item_profile_id_with_item_id');
        });

        // Index for action_taken_endline_header table
        Schema::table('action_taken_endline_header', function (Blueprint $table) {
            $table->index(['repair_id', 'id'], 'idx_header_repair_id');
        });

        // Index for action_taken_endline_detail table
        Schema::table('action_taken_endline_detail', function (Blueprint $table) {
            $table->index(['header_id', 'deleted_at', 'id'], 'idx_detail_header_deleted');
            // Additional index for MAX() subquery optimization
            $table->index(['header_id', 'id', 'deleted_at'], 'idx_detail_max_lookup');
        });

    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('action_taken_endline_detail', function (Blueprint $table) {
            $table->dropIndex('idx_detail_max_lookup');
        });
        Schema::table('action_taken_endline_header', function (Blueprint $table) {
            $table->dropIndex('idx_header_repair_id');
        });
        Schema::table('insp_endline_item', function (Blueprint $table) {
            $table->dropIndex('idx_item_profile_id_with_item_id');
        });
        Schema::table('insp_endline_profile', function (Blueprint $table) {
            $table->dropIndex('idx_profile_workstation_deleted');
        });
        Schema::table('workstation_locates', function (Blueprint $table) {
            $table->dropIndex('idx_workstation_id_deleted');
        });
        Schema::table('insp_endline_repair', function (Blueprint $table) {
            $table->dropIndex('idx_repair_created_deleted');
        });

    }
}
