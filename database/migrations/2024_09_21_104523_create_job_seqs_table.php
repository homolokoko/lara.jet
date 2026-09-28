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
        Schema::create('job_seqs', function (Blueprint $table) {
            $table->integer('id', true);
            $table->integer('no')->nullable();
            $table->string('name')->nullable();
            $table->integer('styles_id')->nullable();
            $table->timestamps();
            $table->integer('style_profile_id')->nullable();
            $table->softDeletes();

            $table->index(['style_profile_id', 'deleted_at']);
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('job_seqs');
    }
};
