<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddColumnRepeatedScanToGarmentTracking extends Migration
{
    public function up(): void
    {
        Schema::table('garment_tracking_transactions', function (Blueprint $table) {
            $table->addColumn('integer', 'repeated')->default(1);
            $table->index('repeated');
        });
    }

    public function down(): void
    {
        Schema::table('garment_tracking_transactions', function (Blueprint $table) {
            $table->dropIndex('garment_tracking_transactions_repeated');
            $table->dropColumn('repeated');
        });
    }
}
