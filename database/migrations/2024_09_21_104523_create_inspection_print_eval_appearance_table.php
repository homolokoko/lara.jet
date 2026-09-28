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
        Schema::create('inspection_print_eval_appearance', function (Blueprint $table) {
            $table->integer('id', true);
            $table->integer('inspection_print_eval_id')->nullable();
            $table->integer('lighter_number')->nullable();
            $table->float('lighter_percent', 10, 0)->nullable();
            $table->integer('standard_number')->nullable();
            $table->float('standard_percent', 10, 0)->nullable();
            $table->integer('darker_number')->nullable();
            $table->float('darker_percent', 10, 0)->nullable();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('inspection_print_eval_appearance');
    }
};
