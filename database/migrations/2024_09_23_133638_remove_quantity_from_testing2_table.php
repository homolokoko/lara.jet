<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class RemoveQuantityFromTesting2Table extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('testing2_table', function (Blueprint $table) {
            $table->dropColumn('quantity'); // Remove the 'quantity' column
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('testing2_table', function (Blueprint $table) {
            $table->integer('quantity'); // Add back the 'quantity' column if rolled back
        });
    }
}
