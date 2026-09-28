<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddQuantityToTestingTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('testing_table', function (Blueprint $table) {
            $table->string('quantity')->after('id'); // Specify where to add the new column
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('testing_table', function (Blueprint $table) {
            $table->dropColumn('quantity'); // Drops the new column if rolled back
        });
    }
}
