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
        Schema::create('inspection_workmanship_check', function (Blueprint $table) {
            $table->integer('id', true);
            $table->integer('header_id')->nullable()->index();
            $table->integer('workmanship_check_id')->nullable()->index();
            $table->boolean('is_critical')->nullable()->default(false);
            $table->boolean('is_major')->nullable()->default(false);
            $table->boolean('is_minor')->nullable()->default(false);
            $table->dateTime('created_at')->nullable();
            $table->dateTime('updated_at')->nullable();
            $table->dateTime('deleted_at')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('inspection_workmanship_check');
    }
};
