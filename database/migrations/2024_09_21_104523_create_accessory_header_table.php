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
        Schema::create('accessory_header', function (Blueprint $table) {
            $table->integer('id', true);
            $table->string('no', 100)->nullable();
            $table->integer('styles_id')->nullable();
            $table->integer('purchase_order_id')->nullable();
            $table->integer('trim_type_id')->nullable();
            $table->integer('supplier_id')->nullable();
            $table->integer('color_id')->nullable();
            $table->integer('order_qty')->nullable();
            $table->integer('receive_qty')->nullable();
            $table->integer('checked_qty')->nullable();
            $table->integer('balance_qty')->nullable();
            $table->integer('is_pass')->nullable()->default(0);
            $table->string('lot_size', 100)->nullable();
            $table->integer('accept')->nullable();
            $table->integer('reject')->nullable();
            $table->integer('sample')->nullable();
            $table->string('image', 100)->nullable();
            $table->timestamps();
            $table->softDeletes();
            $table->date('receive_date')->nullable();
            $table->string('receipt_no')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('accessory_header');
    }
};
