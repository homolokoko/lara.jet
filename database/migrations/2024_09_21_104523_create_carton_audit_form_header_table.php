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
        Schema::create('carton_audit_form_header', function (Blueprint $table) {
            $table->integer('id', true);
            $table->string('doc_no')->nullable();
            $table->integer('style_id')->nullable();
            $table->integer('purchase_order_id')->nullable();
            $table->integer('color_id')->nullable();
            $table->integer('workstation_id')->nullable();
            $table->string('carton_no')->nullable();
            $table->string('ratio')->nullable();
            $table->integer('no_piece_per_ctn')->nullable()->default(0);
            $table->integer('passed_garment_pcs')->nullable()->default(0);
            $table->integer('fail_garment_pcs')->nullable()->default(0);
            $table->integer('is_pass')->nullable()->default(0);
            $table->integer('is_complete')->nullable()->default(0);
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
        Schema::dropIfExists('carton_audit_form_header');
    }
};
