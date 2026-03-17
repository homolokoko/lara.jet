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
        Schema::create('action_taken_stat', function (Blueprint $table) {
            $table->integer('id')->primary();
            $table->dateTime('report_date')->nullable();
            $table->integer('endline_qty')->nullable()->default(0);
            $table->integer('endline_case')->nullable()->default(0);
            $table->integer('inline_qty')->nullable()->default(0);
            $table->integer('inline_case')->nullable()->default(0);
            $table->dateTime('created_at')->nullable();
            $table->dateTime('updated_at')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('action_taken_stat');
    }
};
