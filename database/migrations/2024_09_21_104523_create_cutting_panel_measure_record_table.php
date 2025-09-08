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
        Schema::create('cutting_panel_measure_record', function (Blueprint $table) {
            $table->integer('id', true);
            $table->integer('panel_measure_size_id')->nullable();
            $table->string('actual')->nullable();
            $table->decimal('actual_in_decimal', 10, 5)->nullable();
            $table->boolean('is_positive')->nullable();
            $table->boolean('is_match')->nullable()->default(false);
            $table->string('position', 50)->nullable();

            $table->unique(['id'], 'id');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('cutting_panel_measure_record');
    }
};
