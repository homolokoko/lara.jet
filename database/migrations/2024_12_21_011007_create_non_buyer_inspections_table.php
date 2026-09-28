<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateNonBuyerInspectionsTable extends Migration
{
    public function up(): void
    {
        Schema::create('non_buyer_inspections', function (Blueprint $table) {
            $table->id();
            $table->integer('style_id');
            $table->integer('purchase_order_id');
            $table->boolean('is_pass');
            $table->integer('inspected_qty');
            $table->integer('defect_qty');
            $table->timestamps();
            $table->softDeletes();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('non_buyer_inspections');
    }
}
