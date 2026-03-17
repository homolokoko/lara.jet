<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateFullqcItemTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('fullqc_item', function (Blueprint $table) {
            $table->id();
            $table->string('item_no')->nullable();
            $table->integer('fullqc_profile_id')->nullable();
            $table->integer('size_id')->nullable();
            $table->integer('color_id')->nullable();
            $table->boolean('is_pass')->nullable();
            $table->boolean('is_repair')->nullable();
            $table->boolean('is_acceptable')->nullable();
            $table->integer('accept_qty')->default(0);
            $table->integer('reject_qty')->default(0);
            $table->integer('garment_tracking_id')->nullable();
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
        Schema::dropIfExists('fullqc_item');
    }
}
