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
        Schema::create('inspection_onsite_home_laundry', function (Blueprint $table) {
            $table->integer('header_id')->nullable();
            $table->integer('id', true);
            $table->integer('onsite_home_laundry_id')->nullable();
            $table->integer('checked')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('inspection_onsite_home_laundry');
    }
};
