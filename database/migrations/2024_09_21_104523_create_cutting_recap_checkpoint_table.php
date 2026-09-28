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
        Schema::create('cutting_recap_checkpoint', function (Blueprint $table) {
            $table->integer('id', true);
            $table->integer('cutting_checkpoint_id')->index('cutting_checkpoint_id');
            $table->integer('cutting_recap_id')->index('cutting_recap_id');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('cutting_recap_checkpoint');
    }
};
