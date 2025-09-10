<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateBinTicketsTable extends Migration
{
    public function up(): void
    {
        Schema::create('bin_tickets', function (Blueprint $table) {
            $table->id()->autoIncrement();
            $table->string('number')->index('bin_tickets_number_index');
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('bin_tickets');
    }
}
