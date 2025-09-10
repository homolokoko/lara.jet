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
        Schema::create('autosave_packing', function (Blueprint $table) {
            $table->integer('id', true);
            $table->integer('operator');
            $table->integer('style')->nullable();
            $table->integer('purchaseOrder')->nullable();
            $table->integer('workstation')->nullable();
            $table->integer('profile')->nullable();
            $table->integer('size')->nullable();
            $table->integer('color')->nullable();
            $table->string('apparel', 100)->nullable();
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
        Schema::dropIfExists('autosave_packing');
    }
};
