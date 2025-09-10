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
        Schema::create('inspection_quantity', function (Blueprint $table) {
            $table->integer('id', true);
            $table->integer('header_id')->nullable()->index();
            $table->integer('style_information_id')->nullable()->index();
            $table->integer('po_unit_qty')->nullable();
            $table->integer('po_carton_qty')->nullable();
            $table->integer('shipment_unit_qty')->nullable();
            $table->integer('shipment_carton_qty')->nullable();
            $table->integer('unit_pack_in_carton')->nullable();
            $table->double('unit_not_pack', 5, 2)->nullable();
            $table->double('unit_not_finished', 5, 2)->nullable();
            $table->dateTime('created_at')->nullable();
            $table->dateTime('updated_at')->nullable();
            $table->dateTime('deleted_at')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('inspection_quantity');
    }
};
