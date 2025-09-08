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
        Schema::create('report_inline_daily_operator_locate', function (Blueprint $table) {
            $table->integer('id', true);
            $table->date('report_date')->nullable();
            $table->integer('locate_id')->nullable();
            $table->integer('jobseq_id')->nullable();
            $table->integer('workstation_id')->nullable();
            $table->integer('operator_id')->nullable();
            $table->dateTime('time')->nullable();
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
        Schema::dropIfExists('report_inline_daily_operator_locate');
    }
};
