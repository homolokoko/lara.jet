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
        Schema::create('inspection_wash_eval_hand_feel', function (Blueprint $table) {
            $table->integer('id', true);
            $table->integer('wash_eval_id')->nullable();
            $table->integer('color_id')->nullable();
            $table->float('outOfStandard', 10, 0)->nullable();
            $table->float('stifferThanStandard', 10, 0)->nullable();
            $table->float('standard', 10, 0)->nullable();
            $table->float('softerThanStandard', 10, 0)->nullable();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('inspection_wash_eval_hand_feel');
    }
};
