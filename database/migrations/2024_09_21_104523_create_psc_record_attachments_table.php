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
        Schema::create('psc_record_attachments', function (Blueprint $table) {
            $table->integer('id', true);
            $table->integer('psc_record_list_id')->nullable();
            $table->string('image', 100)->nullable();
            $table->integer('inspector_id')->nullable();
            $table->text('description')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('psc_record_attachments');
    }
};
