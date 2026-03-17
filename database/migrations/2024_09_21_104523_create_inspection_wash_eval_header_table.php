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
        Schema::create('inspection_wash_eval_header', function (Blueprint $table) {
            $table->integer('id', true);
            $table->integer('header_id')->nullable();
            $table->text('findings')->nullable();
            $table->tinyInteger('is_pass')->nullable();
            $table->integer('sample_size')->nullable();
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
        Schema::dropIfExists('inspection_wash_eval_header');
    }
};
