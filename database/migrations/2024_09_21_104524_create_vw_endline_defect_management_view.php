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
        DB::statement("CREATE VIEW `vw_endline_defect_management` AS select substr(md5(group_concat(`lara.jet`.`insp_endline_repair`.`id` separator ',')),1,12) AS `id`,group_concat(`lara.jet`.`insp_endline_repair`.`id` separator ',') AS `case_id`,`lara.jet`.`workstations`.`name` AS `workstation_no`,`lara.jet`.`workstation_locates`.`name` AS `locate_name`,`lara.jet`.`workstation_locates`.`id` AS `locate_id`,cast(`lara.jet`.`insp_endline_repair`.`created_at` as date) AS `report_date`,count(`lara.jet`.`insp_endline_repair`.`insp_endline_item_id`) AS `qty` from ((`lara.jet`.`insp_endline_repair` join `lara.jet`.`workstations` on(`lara.jet`.`insp_endline_repair`.`workstation_id` = `lara.jet`.`workstations`.`id`)) join `lara.jet`.`workstation_locates` on(`lara.jet`.`workstations`.`workstation_locate_id` = `lara.jet`.`workstation_locates`.`id`)) group by cast(`lara.jet`.`insp_endline_repair`.`created_at` as date),`lara.jet`.`workstations`.`id`,`lara.jet`.`workstations`.`name`,`lara.jet`.`workstation_locates`.`name`,`lara.jet`.`workstation_locates`.`id`");
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        DB::statement("DROP VIEW IF EXISTS `vw_endline_defect_management`");
    }
};
