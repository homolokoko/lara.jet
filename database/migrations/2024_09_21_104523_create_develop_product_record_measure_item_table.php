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
        Schema::create('develop_product_record_measure_item', function (Blueprint $table) {
            $table->integer('id', true);
            $table->integer('header_id')->nullable();
            $table->integer('size')->nullable();
            $table->integer('color')->nullable();
            $table->dateTime('created_at')->nullable();
            $table->dateTime('updated_at')->nullable();
            $table->integer('is_pass')->nullable()->default(1);
            $table->text('reason')->nullable();
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
        Schema::dropIfExists('develop_product_record_measure_item');
    }
};
