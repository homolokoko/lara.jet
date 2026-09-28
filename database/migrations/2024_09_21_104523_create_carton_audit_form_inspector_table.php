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
        Schema::create('carton_audit_form_inspector', function (Blueprint $table) {
            $table->integer('id', true);
            $table->integer('carton_audit_form_header_id');
            $table->integer('inspector_id');
            $table->integer('passed_pcs')->nullable()->default(0);
            $table->integer('failed_pcs')->nullable()->default(0);
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
        Schema::dropIfExists('carton_audit_form_inspector');
    }
};
