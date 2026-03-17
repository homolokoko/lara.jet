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
        Schema::create('fbc_checklist', function (Blueprint $table) {
            $table->integer('id', true);
            $table->integer('profile_id')->nullable();
            $table->string('name', 150)->nullable();
            $table->integer('is_pass')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('fbc_checklist');
    }
};
