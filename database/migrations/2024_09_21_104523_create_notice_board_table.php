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
        Schema::create('notice_board', function (Blueprint $table) {
            $table->integer('id', true);
            $table->string('case_id', 100)->nullable();
            $table->text('message')->nullable();
            $table->integer('locate_id')->nullable()->index('locate_id');
            $table->integer('module_id')->nullable()->index('module_id');
            $table->string('found', 100)->nullable();
            $table->string('found_type')->nullable();
            $table->integer('is_action_taken')->nullable()->default(0);
            $table->timestamp('created_at')->nullable();
            $table->dateTime('updated_at')->nullable();
            $table->dateTime('taken_at')->nullable();
            $table->integer('is_close')->nullable()->default(0);
            $table->integer('sent')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('notice_board');
    }
};
