<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddIndexesToJobSeqsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('job_seqs', function (Blueprint $table) {
            // Check and create indexes only if they don't exist
            $indexes = $this->getTableIndexes('job_seqs');

            if ( ! in_array('job_seqs_styles_id_index', $indexes)) {
                $table->index('styles_id');
            }

            if ( ! in_array('job_seqs_style_profile_id_index', $indexes)) {
                $table->index('style_profile_id');
            }

            if ( ! in_array('job_seqs_name_index', $indexes)) {
                $table->index('name');
            }

            if ( ! in_array('job_seqs_no_index', $indexes)) {
                $table->index('no');
            }

            if ( ! in_array('job_seqs_composite_index', $indexes)) {
                $table->index(['styles_id', 'style_profile_id', 'name', 'no'], 'job_seqs_composite_index');
            }
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('job_seqs', function (Blueprint $table) {
            $indexes = $this->getTableIndexes('job_seqs');

            if (in_array('job_seqs_styles_id_index', $indexes)) {
                $table->dropIndex(['styles_id']);
            }

            if (in_array('job_seqs_style_profile_id_index', $indexes)) {
                $table->dropIndex(['style_profile_id']);
            }

            if (in_array('job_seqs_name_index', $indexes)) {
                $table->dropIndex(['name']);
            }

            if (in_array('job_seqs_no_index', $indexes)) {
                $table->dropIndex(['no']);
            }

            if (in_array('job_seqs_composite_index', $indexes)) {
                $table->dropIndex('job_seqs_composite_index');
            }
        });
    }

    /**
     * Get all indexes for a table
     */
    private function getTableIndexes($tableName)
    {
        return array_map(function ($index) {
            return $index->Key_name;
        }, DB::select("SHOW INDEXES FROM {$tableName}"));
    }
}
