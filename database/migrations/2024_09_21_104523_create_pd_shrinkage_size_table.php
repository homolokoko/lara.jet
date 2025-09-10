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
        Schema::create('pd_shrinkage_size', function (Blueprint $table) {
            $table->integer('id', true);
            $table->integer('size_id')->nullable();
            $table->integer('pd_shrinkage_before_id')->nullable();
            $table->decimal('before_cut_by_size', 11, 0)->nullable();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('pd_shrinkage_size');
    }
};
