<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('insp_endline_profile', function (Blueprint $table) {
            $table->integer('id', true)->index('id');
            $table->string('no')->nullable();
            $table->integer('workstation_locates_id')->nullable()->default(0)->index('workstation_locates_id');
            $table->integer('purchase_order_id')->nullable()->default(0)->index('purchase_order_id');
            $table->integer('inspected_pcs')->nullable()->default(0);
            $table->integer('repair_pcs')->nullable()->default(0);
            $table->integer('pass_pcs')->nullable()->default(0);
            $table->integer('reject_pcs')->nullable()->default(0)->comment('is_damage');
            $table->double('reject_rate', 5, 2)->nullable()->default(0);
            $table->integer('inspector_id')->nullable();
            $table->timestamp('created_at')->nullable()->index('created_at');
            $table->timestamp('updated_at')->nullable();
            $table->integer('style_profile_id')->nullable()->index('style_profile_id');
            $table->softDeletes();

            $table->index(['deleted_at', 'workstation_locates_id', 'created_at'], 'insp_profile_idx_deleted_at_workstatio_created_at');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('insp_endline_profile');
    }
};
