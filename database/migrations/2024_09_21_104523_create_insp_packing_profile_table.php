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
        Schema::create('insp_packing_profile', function (Blueprint $table) {
            $table->integer('id', true);
            $table->string('no')->nullable();
            $table->date('report_date')->nullable();
            $table->integer('purchase_order_id')->nullable();
            $table->integer('sample_size_pcs')->nullable()->default(5);
            $table->integer('inspected_pcs')->nullable()->default(0);
            $table->integer('repair_pcs')->nullable()->default(0);
            $table->integer('damage_pcs')->nullable()->default(0);
            $table->integer('pass_pcs')->nullable()->default(0);
            $table->integer('is_completed')->nullable()->default(0);
            $table->boolean('is_green')->default(false);
            $table->boolean('is_yellow')->default(false);
            $table->boolean('is_red')->default(false);
            $table->integer('style_profile_id')->nullable();
            $table->integer('operator_id')->nullable();
            $table->integer('inspector_id')->nullable();
            $table->integer('locate')->nullable()->default(22);
            $table->integer('workstation')->nullable();
            $table->integer('is_open')->nullable()->default(1);
            $table->timestamps();
            $table->softDeletes();
            $table->integer('styles_id')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('insp_packing_profile');
    }
};
