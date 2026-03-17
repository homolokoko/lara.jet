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
        Schema::create('psc_record_profile', function (Blueprint $table) {
            $table->integer('id', true);
            $table->date('report_date')->nullable();
            $table->integer('psc_section_id')->nullable();
            $table->integer('version')->nullable();
            $table->integer('psc_list_id')->nullable();
            $table->tinyInteger('is_finished')->nullable();
            $table->dateTime('created_at')->nullable();
            $table->dateTime('updated_at')->nullable();
            $table->dateTime('deleted_at')->nullable();
            $table->tinyInteger('is_outdated')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('psc_record_profile');
    }
};
