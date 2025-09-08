<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddColumnInspectorAndLocateToGarmentTrackingTransaction extends Migration
{
    public function up(): void
    {
        Schema::table('garment_tracking_transactions', function (Blueprint $table) {
            $table->addColumn('integer', 'inspector');
            $table->addColumn('integer', 'locate');
        });
    }

    public function down(): void
    {
        Schema::table('garment_tracking_transactions', function (Blueprint $table) {
            $table->dropColumn('inspector');
            $table->dropColumn('locate');
        });
    }
}
