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
        Schema::create('aql_plan', function (Blueprint $table) {
            $table->integer('id', true);
            $table->integer('aql_code_id')->index('aql_code_id');
            $table->integer('aql_id')->index('aql_id');
            $table->string('accept')->nullable();
            $table->string('reject')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('aql_plan');
    }
};
