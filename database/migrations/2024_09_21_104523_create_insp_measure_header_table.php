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
        Schema::create('insp_measure_header', function (Blueprint $table) {
            $table->integer('id', true);
            $table->integer('measure_profile_header_id')->nullable();
            $table->integer('styles_id')->nullable();
            $table->string('doc_no', 25)->nullable();
            $table->integer('inspection_profile_id')->nullable();
            $table->integer('inspector_id')->nullable();
            $table->integer('inspected_garment_qty')->nullable()->default(0);
            $table->integer('should_inspect_size_qty')->nullable()->default(0);
            $table->integer('inspected_sizes_qty')->nullable()->default(0);
            $table->integer('total_checked')->nullable()->comment('count the row from measure chart');
            $table->integer('total_acceptable')->nullable();
            $table->integer('total_less')->nullable()->default(0);
            $table->integer('total_more')->nullable()->default(0);
            $table->integer('total_tally')->nullable()->default(0);
            $table->timestamps();
            $table->softDeletes();
            $table->integer('is_complete')->nullable()->default(0);
            $table->integer('is_ignore_incomplete')->nullable()->default(0);
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('insp_measure_header');
    }
};
