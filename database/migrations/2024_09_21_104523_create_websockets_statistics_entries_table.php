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
        Schema::create('websockets_statistics_entries', function (Blueprint $table) {
            $table->integer('id', true);
            $table->string('app_id')->nullable();
            $table->integer('peak_connection_count')->nullable();
            $table->integer('websocket_message_count')->nullable();
            $table->integer('api_message_count')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('websockets_statistics_entries');
    }
};
