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
        Schema::create('insp_endline_repair_log', function (Blueprint $table) {
            $table->integer('id', true);
            $table->integer('insp_endline_repair_id')->nullable();
            $table->boolean('is_pass')->nullable()->default(false);
            $table->boolean('is_damage')->nullable()->default(false);
            $table->boolean('is_repair')->nullable()->default(false);
            $table->timestamps();
            $table->integer('workstation_id')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('insp_endline_repair_log');
    }
};
