<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddColumnShippingDateToNonBuyerInspections extends Migration
{
    public function up(): void
    {
        Schema::table('non_buyer_inspections', function (Blueprint $table) {
            $table->date('shipping_date');
            $table->addColumn('integer','editor_id')->nullable(false);
        });
    }

    public function down(): void
    {
        Schema::table('non_buyer_inspections', function (Blueprint $table) {
            Schema::hasColumn('non_buyer_inspections', 'shipping_date') && $table->dropColumn('shipping_date');
            Schema::hasColumn('non_buyer_inspections', 'editor_id') && $table->dropColumn('editor_id');
        });
    }
}
