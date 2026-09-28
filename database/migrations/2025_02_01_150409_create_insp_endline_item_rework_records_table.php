<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateInspEndlineItemReworkRecordsTable extends Migration
{
    public function up(): void
    {
        Schema::create('insp_endline_item_rework_records', function (Blueprint $table) {
            $table->id();
            $table->integer('locate_id');
            $table->integer('inspector_id');
            $table->boolean('is_pass');
            $table->integer('item_id');
            $table->timestamps();
            $table->softDeletes();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('insp_endline_item_rework_records');
    }
}
