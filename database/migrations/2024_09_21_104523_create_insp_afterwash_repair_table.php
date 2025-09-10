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
        Schema::create('insp_afterwash_repair', function (Blueprint $table) {
            $table->integer('id', true);
            $table->integer('insp_item_id')->nullable()->index('insp_endline_item_id');
            $table->integer('identity_card_id')->nullable()->index('identity_card_id');
            $table->boolean('is_resolve')->nullable()->default(false);
            $table->integer('insp_item_defect_id')->nullable()->default(0)->index('insp_endline_defect_id');
            $table->integer('to_locate')->nullable()->index('to_locate');
            $table->timestamps();
            $table->integer('from_locate')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('insp_afterwash_repair');
    }
};
