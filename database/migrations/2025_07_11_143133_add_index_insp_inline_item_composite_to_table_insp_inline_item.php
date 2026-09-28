<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddIndexInspInlineItemCompositeToTableInspInlineItem extends Migration
{
    public function up(): void
    {
        Schema::table('insp_inline_item', function (Blueprint $table) {
            $table->index(['insp_inline_profile_id', 'id'],'idx_insp_inline_item_composite');
        });
    }

    public function down(): void
    {
        Schema::table('insp_inline_item', function (Blueprint $table) {
            //
            $table->dropIndex('idx_insp_inline_item_composite');
        });
    }
}
