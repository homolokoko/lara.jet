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
        Schema::create('inspection_print_eval_summary', function (Blueprint $table) {
            $table->integer('header_id')->nullable();
            $table->text('color')->nullable();
            $table->text('finding')->nullable();
            $table->tinyInteger('is_pass')->nullable();
            $table->integer('sample_size')->nullable();
            $table->integer('id', true);
            $table->dateTime('created_at')->nullable();
            $table->dateTime('updated_at')->nullable();
            $table->dateTime('deleted_at')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('inspection_print_eval_summary');
    }
};
