<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateMaterialCheckHeaderTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('material_check_header', function (Blueprint $table) {
            $table->id();
            $table->integer('material_audit_header_id');
            $table->longText('remark')->nullable();
            $table->integer('type')->comment('1=Moisture Check,2=Thickness,3=Softness');
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
        Schema::dropIfExists('material_check_header');
    }
}
