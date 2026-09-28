<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddPurchaseOrderIdToInspectionPhotographDetailTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('inspection_photograph_detail', function (Blueprint $table) {
            //
            $table->integer('purchase_order_id')->nullable();

        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('inspection_photograph_detail', function (Blueprint $table) {
            //
            $table->dropColumn('purchase_order_id');
        });
    }
}
