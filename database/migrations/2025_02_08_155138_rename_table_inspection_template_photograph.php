<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class RenameTableInspectionTemplatePhotograph extends Migration
{
    public function up(): void
    {
        Schema::rename('inspection_template_photograph', 'inspection_buyer_photograph_template');
    }

    public function down(): void
    {
        Schema::rename('inspection_buyer_photograph_template', 'inspection_template_photograph');
    }
}
