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
        Schema::create('insp_inline_profile', function (Blueprint $table) {
            $table->integer('id', true);
            $table->string('no')->nullable();
            $table->integer('purchase_order_id')->nullable()->index('purchase_order_id');
            $table->integer('sample_size_pcs')->nullable()->default(5);
            $table->integer('inspected_pcs')->nullable()->default(1);
            $table->integer('repair_pcs')->nullable()->default(0);
            $table->integer('damage_pcs')->nullable()->default(0);
            $table->integer('pass_pcs')->nullable()->default(0);
            $table->softDeletes()->index();
            $table->boolean('is_green')->default(true);
            $table->boolean('is_yellow')->default(false);
            $table->boolean('is_red')->default(false);
            $table->integer('style_profile_id')->nullable()->index('style_profile_id');
            $table->unsignedInteger('inspector_id')->nullable()->default(1)->index('inspector_id');
            $table->timestamp('created_at')->nullable()->index();
            $table->timestamp('updated_at')->nullable();
            $table->unsignedInteger('operator_id')->nullable()->default(1);

            $table->index(['inspector_id', 'inspected_pcs', 'deleted_at']);
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('insp_inline_profile');
    }
};
