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
        Schema::create('cutting_recap', function (Blueprint $table) {
            $table->integer('id', true);
            $table->integer('cutting_header_id')->nullable();
            $table->integer('is_checklist')->nullable()->default(0);
            $table->integer('is_binAudit')->nullable()->default(0);
            $table->integer('is_cutPanel')->nullable()->default(0);
            $table->integer('is_defect')->nullable()->default(0);
            $table->integer('is_checkpoint')->nullable()->default(0);
            $table->string('image')->nullable();
            $table->integer('inspector_id')->nullable();
            $table->integer('is_resolve')->nullable()->default(0);
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
        Schema::dropIfExists('cutting_recap');
    }
};
