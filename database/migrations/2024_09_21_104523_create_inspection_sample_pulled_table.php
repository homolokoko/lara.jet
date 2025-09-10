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
        Schema::create('inspection_sample_pulled', function (Blueprint $table) {
            $table->integer('id', true);
            $table->integer('header_id')->nullable()->index();
            $table->integer('sample_type_id')->nullable()->index();
            $table->text('reason')->nullable();
            $table->integer('style_id')->nullable();
            $table->string('quantity')->nullable();
            $table->timestamps();
            $table->softDeletes();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('inspection_sample_pulled');
    }
};
