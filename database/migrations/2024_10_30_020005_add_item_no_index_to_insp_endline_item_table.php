<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddItemNoIndexToInspEndlineItemTable extends Migration
{
    public function up(): void
    {
        Schema::table('insp_endline_item', function (Blueprint $table) {
            $table->index('item_no'); // Regular index
        });
    }

    public function down(): void
    {
        Schema::table('insp_endline_item', function (Blueprint $table) {
            $table->dropIndex(['column_name']); // Drop the regular index
        });
    }
}
