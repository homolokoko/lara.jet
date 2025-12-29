<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateMaterialFourPointHeaderTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('material_four_point_header', function (Blueprint $table) {
            $table->id();
            $table->integer('material_audit_header_id');
            $table->string('name')->nullable();
            $table->dateTime('receive_date');
            $table->string('roll_number')->nullable();
            $table->decimal('qty_yds')->nullable()->default(0.00);
            $table->decimal('qty_kgs')->nullable()->default(0.00);
            $table->decimal('physical_yard')->nullable()->default(0.00);
            $table->longText('remark')->nullable();
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
        Schema::dropIfExists('material_four_point_header');
    }
}
