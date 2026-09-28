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
        Schema::create('recovery_header', function (Blueprint $table) {
            $table->integer('id', true);
            $table->string('signature')->nullable()->index('signature');
            $table->string('module')->nullable()->comment('endline/packing/finishing');
            $table->integer('identity_card')->nullable();
            $table->integer('is_receive')->nullable()->default(0);
            $table->integer('is_dispose')->nullable()->default(0);
            $table->integer('is_resolved')->nullable()->default(0);
            $table->integer('is_send')->nullable()->default(0);
            $table->integer('close_case')->nullable()->default(0);
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
        Schema::dropIfExists('recovery_header');
    }
};
