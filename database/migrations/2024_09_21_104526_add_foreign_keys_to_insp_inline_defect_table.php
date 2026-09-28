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
        Schema::table('insp_inline_defect', function (Blueprint $table) {
            $table->foreign(['defect_cause_id'], 'insp_inline_defect_ibfk_4')->references(['id'])->on('defects_cause');
            $table->foreign(['defect_category_id'], 'insp_inline_defect_ibfk_1')->references(['id'])->on('defect_category_title')->onDelete('CASCADE');
            $table->foreign(['style_profile_id'], 'insp_inline_defect_ibfk_3')->references(['id'])->on('style_profile');
            $table->foreign(['defects_id'], 'insp_inline_defect_ibfk_2')->references(['id'])->on('defects');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('insp_inline_defect', function (Blueprint $table) {
            $table->dropForeign('insp_inline_defect_ibfk_4');
            $table->dropForeign('insp_inline_defect_ibfk_1');
            $table->dropForeign('insp_inline_defect_ibfk_3');
            $table->dropForeign('insp_inline_defect_ibfk_2');
        });
    }
};
