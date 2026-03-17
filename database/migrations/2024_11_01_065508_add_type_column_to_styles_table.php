<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddTypeColumnToStylesTable extends Migration
{
    public function up(): void
    {
        Schema::table('styles', function (Blueprint $table) {
            $table->string('type')->default('order');
        });
    }

    public function down(): void
    {
        Schema::table('styles', function (Blueprint $table) {
            $table->dropColumn('type');
        });
    }
}
