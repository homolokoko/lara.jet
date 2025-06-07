<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateInlineInspectionBuyerDefectTranslationsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('inline_inspection_buyer_defect_translations', function (Blueprint $table) {
            $table->id();
            $table->integer('inline_inspection_defect_id')->nullable();
            $table->string('locale')->nullable();
            $table->string('translated')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('inline_inspection_buyer_defect_translations');
    }
}
