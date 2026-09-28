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
        Schema::create('clfb_template_content', function (Blueprint $table) {
            $table->integer('id', true);
            $table->integer('clfb_template_id');
            $table->integer('clfb_input_type_id')->nullable();
            $table->text('label')->nullable();
            $table->text('desc')->nullable();
            $table->integer('order')->nullable()->default(1);
            $table->integer('is_required')->default(1);
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
        Schema::dropIfExists('clfb_template_content');
    }
};
