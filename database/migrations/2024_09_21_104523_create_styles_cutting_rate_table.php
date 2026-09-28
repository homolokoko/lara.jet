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
        Schema::create('styles_cutting_rate', function (Blueprint $table) {
            $table->integer('styles_id')->primary();
            $table->decimal('fail_rate', 10)->nullable();
            $table->decimal('cabin_audit_rate', 10)->nullable();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('styles_cutting_rate');
    }
};
