<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddColumnReportViewToAfterwashAuditProfile extends Migration
{
    public function up(): void
    {
        Schema::table('afterwash_audit_profile', function (Blueprint $table) {
            $table->integer('report_view')->default(1)->comment('1=factory, 2=pd');

        });
    }

    public function down(): void
    {
        Schema::table('afterwash_audit_profile', function (Blueprint $table) {
            $table->dropColumn('report_view');

        });
    }
}
