<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddIndexInlineOperatorProfileOperatorToInspInlineOperator extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('insp_inline_operator', function (Blueprint $table) {
            //
            $table->index(['insp_inline_profile_id', 'operator_id'], 'idx_inline_operator_profile_operator');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('insp_inline_operator', function (Blueprint $table) {
            //
            $table->dropIndex('idx_inline_operator_profile_operator');
        });
    }
}
