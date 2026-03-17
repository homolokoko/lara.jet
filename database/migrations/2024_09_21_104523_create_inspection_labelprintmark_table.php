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
        Schema::create('inspection_labelprintmark', function (Blueprint $table) {
            $table->integer('id', true);
            $table->integer('header_id')->nullable();
            $table->integer('label_prt_mark_title')->nullable();
            $table->text('location')->nullable();
            $table->text('find_comment')->nullable();
            $table->integer('is_pass')->nullable()->default(1);
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
        Schema::dropIfExists('inspection_labelprintmark');
    }
};
