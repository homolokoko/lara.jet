<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddIndexToGarmentTrackingEndline extends Migration
{
    public function up(): void
    {
        Schema::table('garment_tracking_endline', function (Blueprint $table) {
            $table->index('garment_tracking_id');
            $table->index('insp_endline_item_id');

        });
    }

    public function down(): void
    {
        Schema::table('garment_tracking_endline', function (Blueprint $table) {
            $table->dropIndex('garment_tracking_endline_garment_tracking_id');
            $table->dropIndex('garment_tracking_endline_insp_endline_item_id');
        });
    }
}
