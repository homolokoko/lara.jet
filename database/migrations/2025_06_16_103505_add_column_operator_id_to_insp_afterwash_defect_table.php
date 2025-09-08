<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddColumnOperatorIdToInspAfterwashDefectTable extends Migration
{
    public function up(): void
    {
        Schema::table('insp_afterwash_defect', function (Blueprint $table) {
            if(Schema::hasColumn('insp_afterwash_defect', 'operator_id') === false){
                $table->integer('operator_id')->nullable()->after('id');
            }
        });
    }

    public function down(): void
    {
        Schema::table('insp_afterwash_defect', function (Blueprint $table) {
            //
            if(Schema::hasColumn('insp_afterwash_defect', 'operator_id')){
                $table->dropColumn('operator_id');
            }
        });
    }
}
