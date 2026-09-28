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
        Schema::table('insp_inline_profile', function (Blueprint $table) {
            $table->foreign(['style_profile_id'], 'insp_inline_profile_ibfk_1')->references(['id'])->on('style_profile');
            $table->foreign(['purchase_order_id'], 'insp_inline_profile_ibfk_4')->references(['id'])->on('purchase_orders');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('insp_inline_profile', function (Blueprint $table) {
            $table->dropForeign('insp_inline_profile_ibfk_1');
            $table->dropForeign('insp_inline_profile_ibfk_4');
        });
    }
};
