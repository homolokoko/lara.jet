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
        Schema::create('measure_tolerance_define', function (Blueprint $table) {
            $table->integer('id', true);
            $table->string('name')->nullable();
            $table->decimal('actual_value', 10, 3)->nullable();
            $table->integer('is_positive')->nullable()->default(1);
            $table->integer('unit_id')->nullable();
            $table->integer('acceptable')->nullable()->default(1);
            $table->decimal('min', 10, 3)->nullable();
            $table->decimal('max', 10, 3)->nullable();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('measure_tolerance_define');
    }
};
