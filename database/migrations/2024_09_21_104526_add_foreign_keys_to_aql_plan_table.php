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
        Schema::table('aql_plan', function (Blueprint $table) {
            $table->foreign(['aql_code_id'], 'aql_plan_ibfk_1')->references(['id'])->on('aql_code');
            $table->foreign(['aql_id'], 'aql_plan_ibfk_2')->references(['id'])->on('aql_level');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('aql_plan', function (Blueprint $table) {
            $table->dropForeign('aql_plan_ibfk_1');
            $table->dropForeign('aql_plan_ibfk_2');
        });
    }
};
