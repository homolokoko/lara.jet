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
        Schema::create('insp_inline_measure', function (Blueprint $table) {
            $table->integer('insp_inline_item_id');
            $table->integer('check_points_id');
            $table->integer('style_profile_id')->nullable();
            $table->integer('style_profile_apperal_id')->nullable();
            $table->integer('is_reject')->nullable();
            $table->timestamps();
            $table->integer('id', true);
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('insp_inline_measure');
    }
};
