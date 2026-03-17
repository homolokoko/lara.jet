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
        Schema::create('identity_card_monitor', function (Blueprint $table) {
            $table->integer('id', true);
            $table->integer('identity_card_id')->nullable()->index('identity_card_id');
            $table->integer('locate_from')->nullable()->index('locate_from');
            $table->integer('locate_to')->nullable()->index('locate_to');
            $table->string('model')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('identity_card_monitor');
    }
};
