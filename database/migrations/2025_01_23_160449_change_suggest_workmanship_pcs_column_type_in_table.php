<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class ChangeSuggestWorkmanshipPcsColumnTypeInTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('inspection_header', function (Blueprint $table) {
            //
            $table->text('suggest_workmanship_pcs')->change();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('inspection_header', function (Blueprint $table) {
            $table->integer('suggest_workmanship_pcs')->change();
        });
    }
}
