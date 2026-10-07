<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddCollumnsToCertificateGradingHeaderTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('certificate_grading_header', function (Blueprint $table) {
            $table->date('date_of_examination')->nullable();
            $table->date('date_of_signature_off')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('certificate_grading_header', function (Blueprint $table) {
            $table->dropColumn('date_of_examination');
            $table->dropcolumn('date_of_signature_off');
        });
    }
}
