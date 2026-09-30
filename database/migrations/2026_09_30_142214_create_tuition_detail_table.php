<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateTuitionDetailTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('tuition_detail', function (Blueprint $table) {
            $table->id();
            $table->foreignId('tuition_info_id')->constrained('tuition_info')->cascadeOnDelete();
            $table->string('desc');
            $table->decimal('amount')->default('0.00');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('tuition_detail');
    }
}
