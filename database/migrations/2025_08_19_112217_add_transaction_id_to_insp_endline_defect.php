<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddTransactionIdToInspEndlineDefect extends Migration
{
    public function up(): void
    {
        Schema::table('insp_endline_defect', function (Blueprint $table) {
            if (!Schema::hasColumn('insp_endline_defect', 'transaction_id')) {
                $table->unsignedBigInteger('transaction_id')->after('id')->nullable()->comment('garment tracking transaction id');
            }
        });
    }

    public function down(): void
    {
        Schema::table('insp_endline_defect', function (Blueprint $table) {
            //
            $table->dropColumn('transaction_id');
        });
    }
}
