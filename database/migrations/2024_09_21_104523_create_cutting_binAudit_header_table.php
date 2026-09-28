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
        Schema::create('cutting_binAudit_header', function (Blueprint $table) {
            $table->integer('id', true);
            $table->integer('cutting_header_id')->nullable();
            $table->string('number', 100)->nullable()->comment('bin tikect number');
            $table->integer('quantity')->nullable();
            $table->integer('total_correct_point')->nullable()->default(0);
            $table->integer('total_wrong_point')->nullable()->default(0);
            $table->integer('total_point')->nullable()->default(0);
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('cutting_binAudit_header');
    }
};
