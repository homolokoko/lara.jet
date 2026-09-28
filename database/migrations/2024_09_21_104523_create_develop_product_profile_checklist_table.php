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
        Schema::create('develop_product_profile_checklist', function (Blueprint $table) {
            $table->integer('id', true);
            $table->integer('editor')->nullable();
            $table->integer('version_id');
            $table->integer('check_list_id')->nullable();
            $table->integer('sort')->nullable()->default(1);
            $table->dateTime('created_at')->nullable();
            $table->dateTime('updated_at')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('develop_product_profile_checklist');
    }
};
