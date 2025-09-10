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
        Schema::create('inspection_photograph_detail', function (Blueprint $table) {
            $table->integer('id', true);
            $table->integer('header_id')->nullable()->index();
            $table->integer('title_id')->nullable()->index();
            $table->string('img')->nullable();
            $table->string('description')->nullable();
            $table->integer('sort')->nullable();
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
        Schema::dropIfExists('inspection_photograph_detail');
    }
};
