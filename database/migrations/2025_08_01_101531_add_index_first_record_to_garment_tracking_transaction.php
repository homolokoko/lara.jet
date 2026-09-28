<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddIndexFirstRecordToGarmentTrackingTransaction extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('garment_tracking_transactions', function (Blueprint $table) {
            //
            $table->index(['module', 'created_at', 'locate', 'is_pass', 'is_first_record'],
            'trackGarmentFirstValid');

            $table->index(['module', 'is_first_record'], 'trackGarmentFirst');
            $table->index(['module', 'created_at'], 'trackGarmentFirstWithDate');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('garment_tracking_transactions', function (Blueprint $table) {
            $table->dropIndex('trackGarmentFirstValid');
            $table->dropIndex('trackGarmentFirst');
            $table->dropIndex('trackGarmentFirstWithDate');
        });
    }
}
