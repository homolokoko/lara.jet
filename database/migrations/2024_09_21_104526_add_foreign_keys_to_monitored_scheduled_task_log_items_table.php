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
        Schema::table('monitored_scheduled_task_log_items', function (Blueprint $table) {
            $table->foreign(['monitored_scheduled_task_id'], 'fk_scheduled_task_id')->references(['id'])->on('monitored_scheduled_tasks')->onDelete('CASCADE');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('monitored_scheduled_task_log_items', function (Blueprint $table) {
            $table->dropForeign('fk_scheduled_task_id');
        });
    }
};
