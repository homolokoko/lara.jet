<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddColumnIsRotateToInspectionImageDefectTable extends Migration
{
    public function up(): void
    {
        Schema::table('inspection_image_defect', function (Blueprint $table) {
            $table->boolean('is_rotate')->default(false);
        });
    }
}
