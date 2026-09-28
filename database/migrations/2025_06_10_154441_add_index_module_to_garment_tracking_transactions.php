<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddIndexModuleToGarmentTrackingTransactions extends Migration
{
    public function up(): void
    {
        Schema::table('garment_tracking_transactions', function (Blueprint $table) {
            $table->index(['garment_tracking_id','module','transaction_accept'],'garment_code_repeated_by_module_index');
        });
    }

    public function down(): void
    {
        Schema::table('garment_tracking_transactions', function (Blueprint $table) {
            $table->dropIndex('garment_code_repeated_by_module_index');
        });
    }
}
