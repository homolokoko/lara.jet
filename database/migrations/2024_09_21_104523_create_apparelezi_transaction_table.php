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
        Schema::create('apparelezi_transaction', function (Blueprint $table) {
            $table->integer('id', true);
            $table->integer('order_no')->nullable()->index();
            $table->integer('qms_line')->nullable()->index();
            $table->integer('qty');
            $table->dateTime('created_at')->index();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('apparelezi_transaction');
    }
};
