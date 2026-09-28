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
        Schema::create('insp_inline_jobseq', function (Blueprint $table) {
            $table->integer('insp_inline_profile_id')->index('insp_inline_profile_id');
            $table->integer('jobseq_id')->index('jobseq_id');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('insp_inline_jobseq');
    }
};
