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
        Schema::create('cutting_header', function (Blueprint $table) {
            $table->integer('id', true);
            $table->string('doc_no', 100)->nullable();
            $table->integer('style_id')->nullable();
            $table->string('cut_lot_no', 100)->nullable();
            $table->integer('workstation_id')->nullable();
            $table->integer('piece_in_lay')->nullable();
            $table->integer('no_bin_per_lay')->nullable();
            $table->integer('should_checked_bin')->nullable();
            $table->integer('checked_bin')->nullable()->default(0);
            $table->integer('wrong_point')->nullable()->default(0);
            $table->integer('correct_point')->nullable()->default(0);
            $table->integer('total_point')->nullable()->default(0);
            $table->decimal('wrong_point_rate', 5)->nullable()->default(0);
            $table->integer('fabric_type_id')->nullable();
            $table->integer('is_checklist_complete')->nullable()->default(0);
            $table->integer('is_cutpanel_complete')->nullable()->default(0);
            $table->integer('is_cabinaudit_complete')->nullable()->default(0);
            $table->integer('is_pass')->nullable()->default(0);
            $table->integer('is_complete')->nullable()->default(0);
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
        Schema::dropIfExists('cutting_header');
    }
};
