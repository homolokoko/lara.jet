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
        Schema::create('insp_afterwash_item', function (Blueprint $table) {
            $table->integer('id', true);
            $table->integer('insp_profile_id')->index('insp_endline_profile_id');
            $table->integer('sizes_id')->nullable();
            $table->boolean('is_pass')->default(true);
            $table->boolean('is_repair')->default(false);
            $table->boolean('is_damage')->default(false)->comment('is_damage = Reject');
            $table->integer('color_id')->nullable()->default(1);
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('insp_afterwash_item');
    }
};
