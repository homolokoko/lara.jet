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
        Schema::create('inspection_wash_eval_jeans', function (Blueprint $table) {
            $table->integer('lessFeathering')->nullable();
            $table->integer('tooIntense')->nullable();
            $table->integer('lessIntense')->nullable();
            $table->integer('context_of_jeans_id')->nullable();
            $table->integer('color_id')->nullable();
            $table->integer('wash_eval_id')->nullable();
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
        Schema::dropIfExists('inspection_wash_eval_jeans');
    }
};
