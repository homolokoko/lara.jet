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
        Schema::create('carton_audit_form_defect', function (Blueprint $table) {
            $table->integer('id', true);
            $table->integer('carton_audit_form_detail_id')->nullable();
            $table->integer('defect_id')->nullable();
            $table->string('image')->nullable();
            $table->integer('defect_cause_id')->nullable();
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
        Schema::dropIfExists('carton_audit_form_defect');
    }
};
