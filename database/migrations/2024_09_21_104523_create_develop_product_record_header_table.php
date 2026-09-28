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
        Schema::create('develop_product_record_header', function (Blueprint $table) {
            $table->integer('id', true);
            $table->date('report_date');
            $table->integer('is_complete')->default(0);
            $table->integer('inspector_id');
            $table->integer('version_id');
            $table->integer('buyer_id');
            $table->integer('styles_id');
            $table->integer('type_id')->nullable();
            $table->dateTime('created_at')->nullable();
            $table->dateTime('updated_at')->nullable();
            $table->integer('is_pass')->nullable()->default(1);
            $table->integer('inspection_type_id')->nullable()->default(0);
            $table->integer('sample_type_id')->nullable()->default(0);
            $table->dateTime('deleted_at')->nullable();
            $table->integer('parent_id')->nullable();
            $table->integer('ordering')->nullable();
            $table->string('path')->nullable();
            $table->integer('depth')->nullable();
            $table->text('reason')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('develop_product_record_header');
    }
};
