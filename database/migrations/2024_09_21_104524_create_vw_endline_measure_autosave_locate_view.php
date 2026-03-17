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
        DB::statement("CREATE VIEW `vw_endline_measure_autosave_locate` AS select max(`lara.jet`.`endline_measure_header`.`id`) AS `latest_header_id`,`lara.jet`.`endline_measure_header`.`locate_id` AS `locate_id` from `lara.jet`.`endline_measure_header` group by `lara.jet`.`endline_measure_header`.`locate_id`");
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        DB::statement("DROP VIEW IF EXISTS `vw_endline_measure_autosave_locate`");
    }
};
