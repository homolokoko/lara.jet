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
        Schema::create('insp_endline_measure', function (Blueprint $table) {
            $table->integer('insp_measure_endline_item_id');
            $table->integer('check_points_id');
            $table->integer('style_profile_id')->nullable();
            $table->integer('style_profile_apperal_id')->nullable();
            $table->integer('is_reject')->nullable();
            $table->timestamp('created_at')->nullable();
            $table->timestamp('updated_at')->default(null);
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
        Schema::dropIfExists('insp_endline_measure');
    }
};
