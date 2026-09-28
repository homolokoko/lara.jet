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
        Schema::table('inspection_section-backup-test', function (Blueprint $table) {
            $table->foreign(['buyer_id'], 'inspection_section-backup-test_ibfk_1')->references(['id'])->on('buyers');
            $table->foreign(['parent_id'], 'inspection_section_parent_id_foreign')->references(['id'])->on('inspection_section-backup-test')->onDelete('CASCADE');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('inspection_section-backup-test', function (Blueprint $table) {
            $table->dropForeign('inspection_section-backup-test_ibfk_1');
            $table->dropForeign('inspection_section_parent_id_foreign');
        });
    }
};
