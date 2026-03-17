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
        Schema::create('inspection_pack_code_detail', function (Blueprint $table) {
            $table->integer('id', true);
            $table->integer('pack_code_header_id')->nullable()->index();
            $table->string('code')->nullable()->index();
            $table->integer('size_id')->nullable()->index();
            $table->integer('color_id')->nullable()->index();
            $table->dateTime('created_at')->nullable();
            $table->dateTime('updated_at')->nullable();
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
        Schema::dropIfExists('inspection_pack_code_detail');
    }
};
