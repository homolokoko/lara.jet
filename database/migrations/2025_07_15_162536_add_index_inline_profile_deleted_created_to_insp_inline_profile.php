<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddIndexInlineProfileDeletedCreatedToInspInlineProfile extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('insp_inline_profile', function (Blueprint $table) {
            //
            $table->index(['deleted_at', 'created_at'], 'idx_inline_profile_deleted_created');
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
            //
            $table->dropIndex('idx_inline_profile_deleted_created');
        });
    }
}
