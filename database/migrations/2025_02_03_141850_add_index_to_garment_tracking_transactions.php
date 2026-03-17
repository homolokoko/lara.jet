<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddIndexToGarmentTrackingTransactions extends Migration
{
    public function up(): void
    {
        Schema::table('garment_tracking_transactions', function (Blueprint $table) {
            $table->index('inspector');
            $table->index('locate');
            $table->index('garment_tracking_id');
        });
    }

    public function down(): void
    {
        Schema::table('garment_tracking_transactions', function (Blueprint $table) {
            $table->dropIndex('garment_tracking_transactions_inspector_index');
            $table->dropIndex('garment_tracking_transactions_locate_index');
            $table->dropIndex('garment_tracking_transactions_garment_tracking_id_index');
        });
    }
}
