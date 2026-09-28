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
        Schema::create('insp_inline_item', function (Blueprint $table) {
            $table->integer('id', true);
            $table->string('item_no')->nullable()->index('item_no');
            $table->integer('insp_inline_profile_id')->index('insp_inline_profile_id');
            $table->integer('sizes_id')->nullable()->index('sizes_id');
            $table->integer('color_id')->nullable()->index('color_id');
            $table->boolean('is_pass')->default(true);
            $table->boolean('is_repair')->default(false);
            $table->boolean('is_damage')->default(false)->comment('cant repair. throw');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('insp_inline_item');
    }
};
