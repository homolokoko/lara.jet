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
        Schema::create('psmfr_items', function (Blueprint $table) {
            $table->integer('id', true);
            $table->integer('no')->nullable()->default(1);
            $table->integer('header_id')->nullable()->index('header_id');
            $table->integer('process_id')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('psmfr_items');
    }
};
