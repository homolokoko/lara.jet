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
        Schema::create('report_inline_log_track_repair', function (Blueprint $table) {
            $table->integer('id', true);
            $table->integer('repair_id')->nullable();
            $table->date('report_date')->nullable();
            $table->integer('operator_id')->nullable();
            $table->string('image', 100)->nullable();
            $table->integer('size_id')->nullable();
            $table->integer('color_id')->nullable();
            $table->integer('purchase_order_id')->nullable();
            $table->integer('style_id')->nullable();
            $table->integer('cause_id')->nullable();
            $table->integer('defect_id')->nullable();
            $table->integer('checkpoint_id')->nullable();
            $table->integer('is_resolve')->nullable();
            $table->dateTime('return_at')->nullable();
            $table->dateTime('created_at')->nullable();
            $table->dateTime('updated_at')->nullable();
            $table->integer('routine')->nullable();
            $table->text('operation_code_list')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('report_inline_log_track_repair');
    }
};
