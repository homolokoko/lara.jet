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
        Schema::create('carton_audit_required_garment', function (Blueprint $table) {
            $table->integer('id', true);
            $table->integer('purchase_order_id')->nullable();
            $table->integer('amount')->nullable()->default(0);
            $table->integer('is_percentage')->nullable()->default(1);
            $table->integer('styles_id')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('carton_audit_required_garment');
    }
};
