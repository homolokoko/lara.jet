<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddIndexModuleToGarmentTrackingTransaction extends Migration
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
            $table->index(['module', 'created_at'], 'idx_garment_tracking_module_created_at');
            $table->index(['module', 'created_at', 'locate', 'is_pass', 'repeated', 'transaction_accept'],'idx_garment_tracking_composite');

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
            $table->dropIndex('idx_garment_tracking_module_created_at');
            $table->dropIndex('idx_garment_tracking_composite');
        });
    }
}
