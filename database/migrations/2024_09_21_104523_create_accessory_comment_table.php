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
        Schema::create('accessory_comment', function (Blueprint $table) {
            $table->integer('id', true);
            $table->integer('accessory_defect_id')->nullable();
            $table->longText('comment')->nullable();
            $table->integer('comment_by')->nullable();
            $table->string('image', 100)->nullable();
            $table->integer('is_resolved')->nullable()->default(0);
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
        Schema::dropIfExists('accessory_comment');
    }
};
