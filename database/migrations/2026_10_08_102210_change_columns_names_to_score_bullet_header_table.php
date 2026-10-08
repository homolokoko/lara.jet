<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class ChangeColumnsNamesToScoreBulletHeaderTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('score_bullet_header', function (Blueprint $table) {
            $table->renameColumn('presented','time_of_leave');
            $table->renameColumn('missed','time_of_absence');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('score_bullet_header', function (Blueprint $table) {
            //
        });
    }
}
