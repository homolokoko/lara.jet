<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('garment_tracking_transactions', function (Blueprint $table) {
            $table->index(
                ['transaction_accept', 'created_at', 'locate', 'deleted_at', 'id'],
                'idx_garment_tracking_main'
            );

        });
        Schema::table('workstation_locates', function (Blueprint $table) {
            // Index for EXISTS subquery optimization
            $table->index(
                ['id', 'is_day_shift'],
                'idx_workstation_locates_day_shift'
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
            $table->dropIndex('idx_garment_tracking_main');
        });

        Schema::table('workstation_locates', function (Blueprint $table) {
            $table->dropIndex('idx_workstation_locates_day_shift');
        });
    }
};
