<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateWorkmanshipCheckBuyersTable extends Migration
{
    public function up(): void
    {
        Schema::create('workmanship_check_buyers', function (Blueprint $table) {
            $table->id();
            $table->integer('workmanship_check_id');
            $table->integer('buyer_id');
            $table->timestamps();
            $table->softDeletes();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('workmanship_check_buyers');
    }
}
