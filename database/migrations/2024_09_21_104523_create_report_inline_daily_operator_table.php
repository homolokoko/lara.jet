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
        Schema::create('report_inline_daily_operator', function (Blueprint $table) {
            $table->integer('id', true);
            $table->date('report_date')->nullable();
            $table->integer('operator_id')->nullable();
            $table->integer('routine')->nullable()->default(0);
            $table->integer('red')->nullable()->default(0);
            $table->integer('yellow')->nullable()->default(0);
            $table->integer('green')->nullable()->default(0);
            $table->text('flag')->nullable();
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
        Schema::dropIfExists('report_inline_daily_operator');
    }
};
