<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddPriceDiscountAvailableOutstockInstockReleaseDateDetailToProductTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('product', function (Blueprint $table) {
            $table->double('price')->default(0.00);
            $table->double('discount')->default(0);
            $table->integer('in_stock')->default(0);
            $table->integer('out_stock')->default(0);
            $table->boolean('is_available')->nullable(false);
            $table->date('release_date')->nullable();
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
        Schema::table('product', function (Blueprint $table) {
            //
        });
    }
}
