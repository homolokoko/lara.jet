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
        Schema::table('aql_sample_letters', function (Blueprint $table) {
            $table->foreign(['aql_inspection_level_id'], 'aql_sample_letters_ibfk_1')->references(['id'])->on('aql_inspect_level');
            $table->foreign(['aql_code_id'], 'aql_sample_letters_ibfk_2')->references(['id'])->on('aql_code');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('aql_sample_letters', function (Blueprint $table) {
            $table->dropForeign('aql_sample_letters_ibfk_1');
            $table->dropForeign('aql_sample_letters_ibfk_2');
        });
    }
};
