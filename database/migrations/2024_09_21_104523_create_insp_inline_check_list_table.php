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
        Schema::create('insp_inline_check_list', function (Blueprint $table) {
            $table->integer('id', true);
            $table->integer('profile_id');
            $table->integer('check_list_id')->nullable();
            $table->integer('is_pass')->nullable()->default(-1);

            $table->unique(['profile_id', 'check_list_id'], 'insp_inline_check_list_pk');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('insp_inline_check_list');
    }
};
