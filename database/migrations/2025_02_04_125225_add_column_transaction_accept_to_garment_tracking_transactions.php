<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddColumnTransactionAcceptToGarmentTrackingTransactions extends Migration
{
    public function up(): void
    {
        Schema::table('garment_tracking_transactions', function (Blueprint $table) {
            $table->addColumn('boolean', 'transaction_accept')->default(true);
        });
    }

    public function down(): void
    {
        Schema::table('garment_tracking_transactions', function (Blueprint $table) {
            $table->dropColumn('transaction_accept');
        });
    }
}
