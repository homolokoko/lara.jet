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
        Schema::create('insp_packing_item', function (Blueprint $table) {
            $table->integer('id', true);
            $table->integer('packing_profile_id')->nullable();
            $table->integer('color_id')->nullable();
            $table->integer('sizes_id')->nullable();
            $table->integer('is_pass')->nullable()->default(0);
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('insp_packing_item');
    }
};
