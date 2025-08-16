<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateFullqcFinishingProfileTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('fullqc_finishing_profile', function (Blueprint $table) {
            $table->id();
            $table->string('no')->nullable();
            $table->integer('location_id')->nullable();
            $table->integer('style_profile_id')->nullable();
            $table->integer('purchase_order_id')->nullable();
            $table->integer('inspected_pcs')->nullable();
            $table->integer('repair_pcs')->default(0);
            $table->integer('pass_pcs')->default(0);
            $table->integer('reject_pcs')->default(0);
            $table->integer('inspector_id')->nullable();
            $table->double('reject_rate')->default(1);
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
        Schema::dropIfExists('fullqc_finishing_profile');
    }
}
