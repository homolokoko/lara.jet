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
        DB::statement("CREATE VIEW `vw_endline_measure_autosave_user` AS select max(`lara.jet`.`endline_measure_header`.`id`) AS `latest_header_id`,max(`lara.jet`.`endline_measure_item`.`id`) AS `latest_item_id`,`lara.jet`.`endline_measure_header`.`inspector_id` AS `inspector_id` from (`lara.jet`.`endline_measure_header` join `lara.jet`.`endline_measure_item` on(`lara.jet`.`endline_measure_item`.`header_id` = `lara.jet`.`endline_measure_header`.`id`)) group by `lara.jet`.`endline_measure_header`.`inspector_id`");
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        DB::statement("DROP VIEW IF EXISTS `vw_endline_measure_autosave_user`");
    }
};
