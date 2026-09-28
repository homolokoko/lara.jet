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
        Schema::create('purchase_orders', function (Blueprint $table) {
            $table->integer('id', true);
            $table->text('no')->nullable();
            $table->integer('style_id')->nullable();
            $table->integer('ship')->nullable()->default(0);
            $table->integer('active')->nullable()->default(1);
            $table->timestamps();
            $table->softDeletes();

            $table->index(['id', 'deleted_at']);
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('purchase_orders');
    }
};
