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
        Schema::create('inspection_measure_header', function (Blueprint $table) {
            $table->integer('id', true);
            $table->integer('inspection_id');
            $table->integer('measure_profile_header_id')->nullable();
            $table->integer('purchase_orders_id')->nullable();
            $table->integer('inspected_garment_qty')->nullable()->default(0);
            $table->integer('should_inspect_size_qty')->nullable()->default(0);
            $table->integer('inspected_sizes_qty')->nullable()->default(0);
            $table->integer('total_chekcpoint_checked')->nullable()->default(0)->comment('count the row from measure chart');
            $table->integer('total_checkpoint_acceptable')->nullable()->default(0);
            $table->integer('total_checkpoint_less')->nullable()->default(0);
            $table->integer('total_checkpoint_more')->nullable()->default(0);
            $table->integer('total_checkpoint_tally')->nullable()->default(0);
            $table->timestamps();
            $table->string('size_class')->nullable();
            $table->string('size_range')->nullable();

        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('inspection_measure_header');
    }
};
