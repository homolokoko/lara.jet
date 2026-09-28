<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateMeasureAuditHeadersTable extends Migration
{
    public function up(): void
    {
        Schema::create('measure_audit_headers', function (Blueprint $table) {
            $table->id();
            $table->string('styles_id');
            $table->string('purchase_order_id');
            $table->string('measurement_profile_id');
            $table->integer('mode')->comment('1 = SEW_ONLINE / 2 = FINISHING / 3 = AFTERWASH'); //
            $table->timestamps();
            $table->softDeletes();

            $table->index(['styles_id', 'purchase_order_id', 'measurement_profile_id', 'mode'], 'profile_mode_index');
            $table->index('mode');
            $table->index('deleted_at');
            $table->index('created_at');
            $table->index('updated_at');

            $table->index(['styles_id', 'purchase_order_id'], 'styles_purchase_order_index');
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('measure_audit_headers');
    }
}
