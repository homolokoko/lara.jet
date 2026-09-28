<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class ChangeColumnSampleAndFail extends Migration
{
    public function up(): void
    {
        Schema::table('inspection_pack_code_header', function (Blueprint $table) {
            $table->text('sample')->change();
            $table->text('fail')->change();

        });
    }

    public function down(): void
    {
        Schema::table('inspection_pack_code_header', function (Blueprint $table) {
            $table->integer('sample')->change();
            $table->integer('fail')->change();
        });
    }
}
