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
        Schema::create('pd_shrinkage_before', function (Blueprint $table) {
            $table->integer('id', true);
            $table->integer('pd_shrinkage_header_id')->nullable();
            $table->integer('size_id')->nullable();
            $table->string('part_name')->nullable();
            $table->decimal('buyer_expected', 10, 3)->nullable();
            $table->decimal('before_cutting', 10, 3)->nullable();
            $table->tinyInteger('remark')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('pd_shrinkage_before');
    }
};
