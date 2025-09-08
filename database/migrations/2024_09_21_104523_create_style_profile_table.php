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
        Schema::create('style_profile', function (Blueprint $table) {
            $table->integer('id', true);
            $table->integer('style_id')->nullable();
            $table->integer('version_id')->nullable();
            $table->timestamps();
            $table->softDeletes();

            $table->index(['style_id', 'deleted_at']);
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('style_profile');
    }
};
