<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddedBinTicketsIdColumnToGarmentTracking extends Migration
{
    public function up(): void
    {
        Schema::table('garment_tracking', function (Blueprint $table) {
            $table->integer('bin_tickets_id')->index('garment_tracking_ibfk_1');
            $table->index('garmentQrCode', 'garment_tracking_ibfk_2');
            $table->dropColumn('module'); // Remove the 'module' column
        });
    }

    public function down(): void
    {
        Schema::table('garment_tracking', function (Blueprint $table) {
            $table->string('module'); // added the 'module' column
            $table->dropColumn('bin_tickets_id'); // Remove the 'bin_tickets_id' column
            $table->dropIndex('garment_tracking_ibfk_1'); // drop index the 'garment_tracking_ibfk_1' column
            $table->dropIndex('garment_tracking_ibfk_2'); // drop index the 'garment_tracking_ibfk_2' column
        });
    }
}
