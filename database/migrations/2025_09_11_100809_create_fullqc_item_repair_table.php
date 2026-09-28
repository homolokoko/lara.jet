<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateFullqcItemRepairTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('fullqc_item_repair', function (Blueprint $table) {
            $table->id();
            $table->integer('fullqc_item_id')->nullable();
            $table->integer('checkpoint_id')->nullable();
            $table->integer('defect_id')->nullable();
            $table->integer('defect_cause_id')->nullable();
            $table->integer('defect_category_id')->nullable();
            $table->integer('style_profile_id')->nullable();
            $table->integer('style_profile_apparel_id')->nullable();
            $table->integer('operator_id')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('fullqc_item_repair');
    }
}
