<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddStylesIdToBinTickets extends Migration{
    public
    function up(): void
    {
        Schema::table('bin_tickets', function (Blueprint $table) {
            if( !Schema::hasColumn('bin_tickets', 'styles_id')){
                $table->integer('styles_id')->nullable()->after('id');
                $table->index('styles_id');
            }
        });
    }

    public function down(): void
    {
        Schema::table('bin_tickets', function (Blueprint $table) {
            //
            $table->dropColumn('styles_id');
            $table->dropIndex('bin_tickets_styles_id_index');
        });
    }
}
