<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateOtherTestBuyersTable extends Migration
{
    public function up(): void
    {
        Schema::create('other_test_buyers', function (Blueprint $table) {
            $table->id();
            $table->integer('titles_id');
            $table->integer('buyers_id');
            $table->softDeletes();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('other_test_buyers');
    }
}
