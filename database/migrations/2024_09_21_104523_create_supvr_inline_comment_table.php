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
        Schema::create('supvr_inline_comment', function (Blueprint $table) {
            $table->integer('insp_measure_inline_item_id')->primary();
            $table->longText('comment')->nullable();
            $table->timestamps();
            $table->integer('commenter_id')->nullable();
            $table->integer('actions_id')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('supvr_inline_comment');
    }
};
