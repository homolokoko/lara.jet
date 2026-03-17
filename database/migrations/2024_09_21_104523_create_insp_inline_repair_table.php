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
        Schema::create('insp_inline_repair', function (Blueprint $table) {
            $table->integer('id', true);
            $table->integer('insp_inline_item_id')->nullable()->index('insp_inline_item_id');
            $table->integer('insp_inline_defect_id')->nullable()->default(0)->index('insp_inline_defect_id');
            $table->integer('insp_inline_measure_id')->nullable()->default(0);
            $table->boolean('is_resolve')->nullable()->default(false);
            $table->timestamps();

            $table->index(['insp_inline_item_id'], 'insp_inline_item_id_2');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('insp_inline_repair');
    }
};
