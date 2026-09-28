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
        Schema::create('insp_inline_repair_comment', function (Blueprint $table) {
            $table->integer('id', true);
            $table->integer('insp_inline_repair_log_id')->nullable();
            $table->text('comment')->nullable();
            $table->integer('inspector_id')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('insp_inline_repair_comment');
    }
};
