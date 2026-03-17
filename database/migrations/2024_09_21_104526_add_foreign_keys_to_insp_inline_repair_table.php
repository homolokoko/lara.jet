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
        Schema::table('insp_inline_repair', function (Blueprint $table) {
            $table->foreign(['insp_inline_item_id'], 'insp_inline_repair_ibfk_1')->references(['id'])->on('insp_inline_item');
            $table->foreign(['insp_inline_defect_id'], 'insp_inline_repair_ibfk_2')->references(['id'])->on('insp_inline_defect')->onUpdate('CASCADE')->onDelete('CASCADE');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('insp_inline_repair', function (Blueprint $table) {
            $table->dropForeign('insp_inline_repair_ibfk_1');
            $table->dropForeign('insp_inline_repair_ibfk_2');
        });
    }
};
