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
        Schema::create('insp_afterwash_profile', function (Blueprint $table) {
            $table->integer('id', true);
            $table->date('report_date')->nullable();
            $table->integer('hour')->nullable();
            $table->integer('inspect_locate_id')->nullable();
            $table->integer('inspected_pcs')->nullable()->default(0);
            $table->integer('repair_pcs')->nullable()->default(0);
            $table->integer('pass_pcs')->nullable()->default(0);
            $table->integer('reject_pcs')->nullable()->default(0)->comment('is_damage');
            $table->double('reject_rate', 5, 2)->nullable()->default(0);
            $table->integer('purchase_order_id')->nullable()->default(0)->index('purchase_order_id');
            $table->integer('styles_id')->nullable();
            $table->integer('style_profile_id')->nullable()->index('style_profile_id');
            $table->integer('inspector_id')->nullable();
            $table->integer('locates_id')->nullable()->default(0)->index('workstation_locates_id');
            $table->timestamps();
            $table->softDeletes();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('insp_afterwash_profile');
    }
};
