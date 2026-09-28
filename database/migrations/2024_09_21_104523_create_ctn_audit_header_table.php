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
        Schema::create('ctn_audit_header', function (Blueprint $table) {
            $table->integer('id', true);
            $table->integer('clfb_template_id')->nullable()->default(1);
            $table->string('no', 21)->nullable();
            $table->integer('style_id')->nullable();
            $table->integer('purchase_order_id')->nullable();
            $table->integer('inspector_id')->nullable();
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
        Schema::dropIfExists('ctn_audit_header');
    }
};
