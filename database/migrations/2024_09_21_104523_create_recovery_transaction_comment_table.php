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
        Schema::create('recovery_transaction_comment', function (Blueprint $table) {
            $table->integer('id', true);
            $table->integer('transaction_id')->nullable();
            $table->string('image')->nullable();
            $table->text('comment')->nullable();
            $table->integer('action')->nullable()->comment('1=recovery seccuss / 2 = dispose');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('recovery_transaction_comment');
    }
};
