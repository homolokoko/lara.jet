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
        Schema::create('cutting_recap_log', function (Blueprint $table) {
            $table->integer('id', true);
            $table->integer('cutting_recap_id')->nullable();
            $table->text('comment')->nullable();
            $table->string('image')->nullable();
            $table->integer('author')->nullable();
            $table->integer('is_resolve')->nullable()->default(1);
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
        Schema::dropIfExists('cutting_recap_log');
    }
};
