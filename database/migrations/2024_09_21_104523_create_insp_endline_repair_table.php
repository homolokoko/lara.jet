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
        Schema::create('insp_endline_repair', function (Blueprint $table) {
            $table->integer('id', true);
            $table->integer('insp_endline_item_id')->nullable()->index('insp_endline_item_id');
            $table->integer('workstation_id')->nullable()->index('workstation_id');
            $table->boolean('is_resolve')->nullable()->default(false)->index('is_resolve');
            $table->timestamps();
            $table->integer('identity_card_id')->nullable()->index('identity_card_id');
            $table->integer('insp_endline_defect_id')->nullable()->default(0)->index('insp_endline_defect_id');
            $table->integer('insp_endline_measure_id')->nullable()->default(0);

            $table->index(['created_at', 'id'], 'created_at');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('insp_endline_repair');
    }
};
