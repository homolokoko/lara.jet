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
        Schema::create('accessory_defect', function (Blueprint $table) {
            $table->integer('id', true);
            $table->integer('accessory_header_id');
            $table->integer('defect_id');
            $table->integer('trim_type_id');
            $table->integer('is_resolved')->nullable()->default(0);
            $table->timestamps();
            $table->integer('inspector_id')->nullable();
            $table->integer('action_by')->nullable();
            $table->integer('qty')->nullable()->default(1);
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('accessory_defect');
    }
};
