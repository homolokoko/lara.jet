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
        Schema::create('inspection_section-backup-test', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->text('name')->nullable();
            $table->unsignedBigInteger('parent_id')->nullable()->index('inspection_section_parent_id_foreign');
            $table->string('path', 191)->nullable();
            $table->unsignedInteger('depth')->nullable();
            $table->unsignedInteger('weight')->default(0);
            $table->integer('ordering')->nullable();
            $table->dateTime('created_at')->nullable();
            $table->dateTime('updated_at')->nullable();
            $table->dateTime('deleted_at')->nullable();
            $table->integer('buyer_id')->nullable()->index('inspection_section-backup-test_ibfk_1');
            $table->integer('lock')->nullable()->default(0);
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('inspection_section-backup-test');
    }
};
