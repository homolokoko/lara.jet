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
        Schema::create('inspection_pack_assortment_detail', function (Blueprint $table) {
            $table->integer('id', true);
            $table->integer('pack_assortment_header_id')->index('header_id_index');
            $table->string('type', 100)->index('type_index');
            $table->string('expected_qty', 100)->nullable();
            $table->string('expected_length', 100)->nullable();
            $table->string('expected_width', 100)->nullable();
            $table->string('expected_height', 100)->nullable();
            $table->string('expected_other', 100)->nullable();
            $table->string('expected_tolerance', 100)->nullable();
            $table->string('expected_weight', 100)->nullable();
            $table->string('actual_qty', 100)->nullable();
            $table->string('actual_length', 100)->nullable();
            $table->string('actual_width', 100)->nullable();
            $table->string('actual_height', 100)->nullable();
            $table->string('actual_other', 100)->nullable();
            $table->string('actual_tolerance', 100)->nullable();
            $table->string('actual_weight', 100)->nullable();
            $table->integer('is_pass');
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
        Schema::dropIfExists('inspection_pack_assortment_detail');
    }
};
