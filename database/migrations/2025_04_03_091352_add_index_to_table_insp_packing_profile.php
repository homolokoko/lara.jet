<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up(): void
    {
        Schema::table('insp_packing_profile', function (Blueprint $table) {
            $table->index([
                'styles_id', 'purchase_order_id', 'style_profile_id', 'report_date', 'inspector_id', 'operator_id',
                'workstation'
            ], 'insp_packing_profile_composite_index');
        });
    }

    public function down(): void
    {
        Schema::table('insp_packing_profile', function (Blueprint $table) {
            $table->dropIndex('insp_packing_profile_composite_index');
        });
    }
};
