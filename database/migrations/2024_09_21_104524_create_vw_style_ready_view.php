<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Support\Facades\DB;

return new class extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        DB::statement("CREATE VIEW `vw_style_ready` AS select 1 AS `id`,1 AS `name`,1 AS `profile`,1 AS `purchase_orders`,1 AS `operation`,1 AS `cutting_panel`,1 AS `measure`,1 AS `buyer_id`");
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        DB::statement("DROP VIEW IF EXISTS `vw_style_ready`");
    }
};
