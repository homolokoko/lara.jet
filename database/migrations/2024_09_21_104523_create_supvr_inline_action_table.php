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
        Schema::create('supvr_inline_action', function (Blueprint $table) {
            $table->integer('insp_inline_profile_id')->nullable();
            $table->boolean('is_pending')->nullable()->comment('problem waiting');
            $table->boolean('is_resolve')->nullable()->comment('problem solve');
            $table->boolean('is_wait')->nullable()->comment('waiting supervisor');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('supvr_inline_action');
    }
};
