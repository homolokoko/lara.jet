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
        Schema::table('styles_purchase_orders', function (Blueprint $table) {
            $table->foreign(['styles_id'], 'styles_purchase_orders_ibfk_1')->references(['id'])->on('styles')->onDelete('CASCADE');
            $table->foreign(['purchase_orders_id'], 'styles_purchase_orders_ibfk_2')->references(['id'])->on('purchase_orders')->onDelete('CASCADE');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('styles_purchase_orders', function (Blueprint $table) {
            $table->dropForeign('styles_purchase_orders_ibfk_1');
            $table->dropForeign('styles_purchase_orders_ibfk_2');
        });
    }
};
