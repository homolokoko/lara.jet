<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddColumnGarmentTrackingTransactionIdToActionTakenEndlineHeaderTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('action_taken_endline_header', function (Blueprint $table) {
            //
            $tableName = 'action_taken_endline_header';
            if (!Schema::hasColumn($tableName, 'defect_record_id')) {
                $table->unsignedBigInteger('defect_record_id')->after('id');
            }

            if (!Schema::hasColumn($tableName, 'is_pending')) {
                $table->boolean('is_pending')->default(true)->after('defect_record_id')
                    ->comment('0 = action taken, 1 = pending action taken');
            }

            if (!Schema::hasColumn($tableName, 'is_resolved')) {
                $table->boolean('is_resolved')->default(false)->after('is_pending')
                    ->comment('0 = not resolved, 1 = resolved');
            }

            if (!Schema::hasColumn($tableName, 'problem_transaction_id')) {
                $table->unsignedBigInteger('problem_transaction_id')->nullable()->after('is_resolved');
            }

            if (!Schema::hasColumn($tableName, 'resolved_transaction_id')) {
                $table->unsignedBigInteger('resolved_transaction_id')->nullable()->after('problem_transaction_id');
            }

            if (!Schema::hasColumn($tableName, 'garment_tracking_id')) {
                $table->unsignedBigInteger('garment_tracking_id')->nullable()->after('resolved_transaction_id');
            }

            if (!Schema::hasColumn($tableName, 'problem_locate_id')) {
                $table->unsignedBigInteger('problem_locate_id')->nullable()->after('garment_tracking_id');
            }
            if (!Schema::hasColumn($tableName, 'resolve_locate_id')) {
                $table->unsignedBigInteger('resolve_locate_id')->nullable()->after('problem_locate_id');
            }
            if(!$this->indexExists($tableName, 'defect_record_id_index')){
                $table->index('defect_record_id','defect_record_id_index');
            }
            if(!$this->indexExists($tableName, 'problem_transaction_id_index')){
                $table->index('problem_transaction_id','problem_transaction_id_index');
            }
            if(!$this->indexExists($tableName, 'resolved_transaction_id_index')){
                $table->index('resolved_transaction_id','resolved_transaction_id_index');
            }
            if(!$this->indexExists($tableName, 'garment_tracking_id_index')){
                $table->index('garment_tracking_id','garment_tracking_id_index');
            }
            if(!$this->indexExists($tableName, 'problem_locate_id_index')){
                $table->index('problem_locate_id','problem_locate_id_index');
            }
            if(!$this->indexExists($tableName, 'resolve_locate_id_index')){
                $table->index('resolve_locate_id','resolve_locate_id_index');
            }
            if(!$this->indexExists($tableName, 'defect_record_id_is_resolved_is_pending')){
                $table->index([
                    'defect_record_id',
                    'is_resolved',
                    'is_pending',
                ],'defect_record_id_is_resolved_is_pending');
            }
        });
    }
    function indexExists(string $table, string $indexName): bool
    {
        $schema = DB::getDatabaseName();
        $result = DB::select("SHOW INDEX FROM {$table} WHERE Key_name = ?", [$indexName]);
        return !empty($result);
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('action_taken_endline_header', function (Blueprint $table) {
            $table->dropColumn([
                'endline_defect_record_id',
                'is_pending',
                'is_resolved',
                'problem_transaction_id',
                'resolved_transaction_id',
                'garment_tracking_id',
                'problem_locate_id',
            ]);
        });
    }
}
