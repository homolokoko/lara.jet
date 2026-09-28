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
        Schema::create('style_wash_type', function (Blueprint $table) {
            $table->integer('id', true);
            $table->integer('wash_type_id')->nullable();
            $table->integer('styles_id')->nullable();

            $table->index(['styles_id', 'wash_type_id']);
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('style_wash_type');
    }
};
