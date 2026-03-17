<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddColumnItemNoToInspAfterwashItemTable extends Migration
{
    public function up(): void
    {
        Schema::table('insp_afterwash_item', function (Blueprint $table) {
            if (!Schema::hasColumn('insp_afterwash_item', 'item_no')) {
                $table->string('item_no')->nullable();
            }
        });
    }

    public function down(): void
    {
        Schema::table('insp_afterwash_item', function (Blueprint $table) {
            //
            $table->dropColumn('item_no');
        });
    }
}
