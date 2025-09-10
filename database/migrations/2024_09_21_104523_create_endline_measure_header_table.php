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
        Schema::create('endline_measure_header', function (Blueprint $table) {
            $table->integer('id', true)->index('id');
            $table->date('date')->nullable();
            $table->integer('style_id')->nullable()->index('style_id');
            $table->integer('locate_id')->index('locate_id');
            $table->unsignedInteger('inspector_id')->nullable()->default(1)->index('inspector_id');
            $table->integer('purchase_orders_id')->nullable();
            $table->integer('measure_profile_header_id')->nullable()->index('measure_profile_header_id');
            $table->integer('inspected_garment_qty')->nullable()->default(0);
            $table->integer('sent_repair')->nullable()->default(0);
            $table->integer('return_repair')->nullable()->default(0);
            $table->integer('total_checkpoint_checked')->nullable()->default(0)->comment('count the row from measure chart');
            $table->integer('total_checkpoint_acceptable')->nullable()->default(0);
            $table->integer('total_checkpoint_less')->nullable()->default(0);
            $table->integer('total_checkpoint_more')->nullable()->default(0);
            $table->integer('total_checkpoint_tally')->nullable()->default(0);
            $table->timestamps();
            $table->softDeletes();

        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('endline_measure_header');
    }
};
