<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddIndexAcceptRepeatedDateLocateToGarmentTrackingTransactions extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('garment_tracking_transactions', function (Blueprint $table) {
            $table->index(
                ['transaction_accept', 'repeated', 'created_at', 'locate', 'is_pass'],
                'idx_gtt_accept_repeated_created_locate_pass'
            );
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
            //
            $table->dropIndex('idx_gtt_accept_repeated_date_locate');
            $table->dropIndex('idx_gtt_accept_repeated_created_locate_pass');
        });
    }
}
