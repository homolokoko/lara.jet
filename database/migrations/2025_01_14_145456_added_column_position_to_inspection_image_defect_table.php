<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddedColumnPositionToInspectionImageDefectTable extends Migration
{
    public function up(): void
    {
        Schema::table('inspection_image_defect', function (Blueprint $table) {
            $table->longText('position')->after('inspection_id')->nullable();
        });
    }

    public function down(): void
    {
        Schema::table('inspection_image_defect', function (Blueprint $table) {
            //
            $table->dropColumn('position');
        });
    }
}
