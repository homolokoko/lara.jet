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
        Schema::create('cutting_panel_pattern', function (Blueprint $table) {
            $table->integer('measure_detail_id')->nullable()->index('cutting_measure_checkpoint_pattern_measure_detail_id_index');
            $table->integer('cutting_panel_id')->nullable()->index('cutting_measure_checkpoint_pattern_cutting_panel_id_index');
            $table->integer('size_id')->nullable()->index();
            $table->float('pattern', 10, 6)->nullable();
            $table->string('shrinkage', 6)->nullable()->index()->comment('width / height');
            $table->integer('id')->nullable();

            $table->index(['measure_detail_id', 'cutting_panel_id', 'size_id', 'shrinkage'], 'checkpoint_panel_size_shrinkage');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('cutting_panel_pattern');
    }
};
