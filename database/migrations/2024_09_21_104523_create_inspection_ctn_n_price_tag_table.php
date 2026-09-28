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
        Schema::create('inspection_ctn_n_price_tag', function (Blueprint $table) {
            $table->integer('id', true);
            $table->integer('header_id')->nullable();
            $table->longText('purchase_order')->nullable();
            $table->integer('color_id')->nullable();
            $table->string('type', 100)->nullable()->comment('ctn_sticker / price_tag');
            $table->dateTime('created_at')->nullable();
            $table->dateTime('deleted_at')->nullable();
            $table->dateTime('updated_at')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('inspection_ctn_n_price_tag');
    }
};
