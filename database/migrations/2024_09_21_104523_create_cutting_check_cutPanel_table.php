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
        Schema::create('cutting_check_cutPanel', function (Blueprint $table) {
            $table->integer('id', true);
            $table->integer('cutting_header_id')->nullable();
            $table->integer('cutting_panel_id')->nullable();
            $table->integer('size_id')->nullable();
            $table->integer('top_is_correct')->nullable()->default(0);
            $table->integer('middle_is_correct')->nullable()->default(0);
            $table->integer('bottom_is_correct')->nullable()->default(0);
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
        Schema::dropIfExists('cutting_check_cutPanel');
    }
};
