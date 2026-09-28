<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class InlineInspectionBuyerDefectServerity extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        //
        Schema::create('inline_inspection_buyer_defect_serverity', function (Blueprint $table) {
            $table->id();
            $table->integer('inline_inspection_buyer_defect_id');
            $table->integer('value');
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
        //
        Schema::dropIfExists('inline_inspection_buyer_defect_serverity');
    }
}
