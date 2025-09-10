<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateInspEmbellishmentProfile extends Migration
{
    public function up(): void
    {
        Schema::create('insp_embellishment_profile', function (Blueprint $table) {
            $table->integer('id', true);
            $table->date('report_date')->nullable()->index('report_date');
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
            $table->integer('operator_id')->nullable()->index('operator_id');
            $table->integer('inspector_id')->nullable();
            $table->integer('locate')->nullable()->default(52);
            $table->integer('workstation')->nullable();
            $table->integer('is_open')->nullable()->default(1);
            $table->timestamps();
            $table->softDeletes();
            $table->integer('styles_id')->nullable();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('insp_embellishment_profile');
    }
}
