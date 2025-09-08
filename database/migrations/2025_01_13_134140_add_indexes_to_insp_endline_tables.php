<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddIndexesToInspEndlineTables extends Migration
{
    /**
     * Array of tables and their indexes
     */
    private $indexes = [
        'insp_endline_profile' => [
            'idx_group_by_columns' => ['workstation_locates_id', 'created_at']
        ],
        'insp_endline_item' => [
            'idx_insp_item_profile_id' => ['insp_endline_profile_id']
        ],
        'insp_endline_defect' => [
            'idx_insp_defect_item_id' => ['insp_measure_endline_item_id']
        ]
    ];

    /**
     * Check if index exists
     */
    private function indexExists($table, $indexName): bool
    {
        $conn = DB::connection()->getDoctrineSchemaManager();
        $indexes = $conn->listTableIndexes($table);
        return isset($indexes[$indexName]);
    }

    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        foreach ($this->indexes as $table => $tableIndexes) {
            Schema::table($table, function (Blueprint $table) use ($tableIndexes) {
                foreach ($tableIndexes as $indexName => $columns) {
                    // Drop index if it exists
                    if ($this->indexExists($table->getTable(), $indexName)) {
                        $table->dropIndex($indexName);
                    }

                    // Create new index
                    $table->index($columns, $indexName);
                }
            });
        }
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        foreach ($this->indexes as $table => $tableIndexes) {
            Schema::table($table, function (Blueprint $table) use ($tableIndexes) {
                foreach ($tableIndexes as $indexName => $columns) {
                    if ($this->indexExists($table->getTable(), $indexName)) {
                        $table->dropIndex($indexName);
                    }
                }
            });
        }
    }
}
