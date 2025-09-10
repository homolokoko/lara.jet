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
        Schema::create('print_endline_measure', function (Blueprint $table) {
            $table->integer('id', true);
            $table->string('jobs_id')->nullable();
            $table->string('case_no')->nullable();
            $table->integer('style')->nullable();
            $table->date('date')->nullable();
            $table->integer('requested_by')->nullable();
            $table->integer('locate')->nullable();
            $table->double('progress', 5, 2)->nullable();
            $table->dateTime('created_at')->nullable();
            $table->dateTime('updated_at')->nullable();
            $table->dateTime('downloaded_at')->nullable();
            $table->text('file_path')->nullable();
            $table->string('status')->nullable();
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
        Schema::dropIfExists('print_endline_measure');
    }
};
