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
        Schema::create('aql_sample_letters', function (Blueprint $table) {
            $table->integer('id', true);
            $table->integer('lot_size_min')->nullable();
            $table->integer('lot_size_max')->nullable();
            $table->integer('aql_inspection_level_id')->nullable()->index('aql_inspection_level_id');
            $table->integer('aql_code_id')->nullable()->index('aql_code_id');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('aql_sample_letters');
    }
};
