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
        Schema::create('styles_purchase_orders', function (Blueprint $table) {
            $table->integer('styles_id')->index('styles_id');
            $table->integer('purchase_orders_id')->index('purchase_orders_id');

            $table->index(['styles_id', 'purchase_orders_id']);
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('styles_purchase_orders');
    }
};
