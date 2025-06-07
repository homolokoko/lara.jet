<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateInlineInspectionBuyerDefectServerityTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('inline_inspection_buyer_defect_serverity', function (Blueprint $table) {
            $table->id();
            $table->integer('inline_inspection_buyer_defect_id')->nullable();
            $table->integer('type')->nullable();
            $table->boolean('value')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('inline_inspection_buyer_defect_serverity');
    }
}
