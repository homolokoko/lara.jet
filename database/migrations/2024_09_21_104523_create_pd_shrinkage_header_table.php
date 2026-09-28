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
        Schema::create('pd_shrinkage_header', function (Blueprint $table) {
            $table->integer('id', true);
            $table->integer('buyer_id')->nullable();
            $table->integer('style_id')->nullable();
            $table->integer('version_id')->nullable();
            $table->integer('pd_shrinkage_fabric_id')->nullable();
            $table->timestamps();
            $table->softDeletes();
            $table->integer('pd_shrinkage_sample_id')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('pd_shrinkage_header');
    }
};
