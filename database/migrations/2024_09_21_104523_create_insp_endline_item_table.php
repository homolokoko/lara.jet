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
        Schema::create('insp_endline_item', function (Blueprint $table) {
            $table->integer('id', true);
            $table->string('item_no')->nullable()->index('insp_item_idx_insp_id');
            $table->integer('insp_endline_profile_id')->index('insp_endline_profile_id');
            $table->integer('sizes_id')->nullable()->index();
            $table->boolean('is_pass')->default(true)->index();
            $table->boolean('is_repair')->default(false)->index();
            $table->boolean('is_damage')->default(false)->comment('is_damage = Reject');
            $table->integer('color_id')->nullable()->default(1)->index();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('insp_endline_item');
    }
};
