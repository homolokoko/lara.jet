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
        Schema::create('psc_list', function (Blueprint $table) {
            $table->integer('id', true);
            $table->integer('psc_checkpoint_id')->nullable();
            $table->string('parent_id', 100)->nullable();
            $table->integer('weight')->nullable();
            $table->integer('depth')->nullable();
            $table->string('path', 100)->nullable();
            $table->integer('version')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('psc_list');
    }
};
