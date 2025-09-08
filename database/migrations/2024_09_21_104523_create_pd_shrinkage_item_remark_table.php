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
        Schema::create('pd_shrinkage_item_remark', function (Blueprint $table) {
            $table->integer('id', true);
            $table->integer('pd_shrinkage_after_id')->nullable();
            $table->longText('comment')->nullable();
            $table->string('src_path')->nullable();
            $table->tinyInteger('is_remark')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('pd_shrinkage_item_remark');
    }
};
