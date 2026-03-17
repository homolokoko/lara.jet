<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateTableInspFinishingItemDefect extends Migration
{
    public function up(): void
    {
        Schema::create('insp_finishing_item_defect', function (Blueprint $table) {
            $table->integer('id', true);
            $table->integer('item_id')->nullable();
            $table->string('image', 100)->nullable();
            $table->integer('defects_id')->nullable();
            $table->integer('defects_category_id')->nullable();
            $table->integer('defects_cause_id')->nullable();
            $table->text('comment')->nullable();
            $table->integer('is_resolve')->nullable()->default(0);
            $table->string('action')->nullable();
            $table->integer('check_points_id')->nullable();
            $table->integer('identity_card')->nullable();
            $table->integer('jobseq')->nullable();
            $table->dateTime('resolved_at')->nullable();
            $table->dateTime('created_at')->nullable();
            $table->dateTime('updated_at')->nullable();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('insp_finishing_item_defect');
    }
}
