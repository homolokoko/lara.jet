<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateTableInspFinishingItem extends Migration
{
    public function up(): void
    {
        Schema::create('insp_finishing_item', function (Blueprint $table) {
            $table->integer('id', true);
            $table->integer('profile_id')->nullable();
            $table->integer('apparel_id')->nullable();
            $table->integer('color_id')->nullable();
            $table->integer('sizes_id')->nullable();
            $table->integer('is_pass')->nullable()->default(0);
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('insp_finishing_item');
    }
}
