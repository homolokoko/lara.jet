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
        Schema::create('cutting_header_shrinkage', function (Blueprint $table) {
            $table->integer('header_id');
            $table->integer('id', true);
            $table->float('width', 4)->nullable();
            $table->float('height', 4)->nullable();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('cutting_header_shrinkage');
    }
};
