<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddColumnRepeatedIndexToGarmentTrackingTransactionsTable extends Migration
{
    public function up(): void
    {
        Schema::table('garment_tracking_transactions', function (Blueprint $table) {
            $table->index('transaction_accept');
            $table->index('is_pass');
        });
    }

    public function down(): void
    {
        Schema::table('garment_tracking_transactions', function (Blueprint $table) {
            $table->dropIndex('garment_tracking_transactions_transaction_accept_index');
            $table->dropIndex('garment_tracking_transactions_is_pass_index');
        });
    }
}
