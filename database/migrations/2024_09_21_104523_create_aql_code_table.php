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
        Schema::create('aql_code', function (Blueprint $table) {
            $table->integer('id', true);
            $table->string('name', 1)->nullable();
            $table->integer('sample_size')->nullable();

            $table->index(['id', 'name'], 'id');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('aql_code');
    }
};
