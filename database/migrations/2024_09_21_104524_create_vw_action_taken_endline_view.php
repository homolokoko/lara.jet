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
        DB::statement("CREATE VIEW `vw_action_taken_endline` AS select `lara.jet`.`insp_endline_repair`.`id` AS `id`,`lara.jet`.`insp_endline_repair`.`id` AS `case_id`,`lara.jet`.`insp_endline_repair`.`created_at` AS `report_date`,if(sum(`lara.jet`.`insp_endline_repair`.`is_resolve`) > 0,1,0) AS `repaired`,sum(if(`lara.jet`.`action_taken_endline_header`.`id` is null,1,if(`lara.jet`.`action_taken_endline_detail`.`id` is null,1,0))) AS `pending`,if(sum(if(`lara.jet`.`action_taken_endline_header`.`id` is null,0,if(`lara.jet`.`action_taken_endline_detail`.`id` is null,0,1))) > 0,1,0) AS `taken`,`lara.jet`.`workstations`.`name` AS `workstation_number`,`lara.jet`.`workstation_locates`.`name` AS `locate_name`,`lara.jet`.`workstation_locates`.`id` AS `locate_id`,`lara.jet`.`workstation_locates`.`sort` AS `locate_sort`,`lara.jet`.`insp_endline_defect`.`defects_id` AS `defects`,`lara.jet`.`insp_endline_defect`.`check_points_id` AS `check_points`,`lara.jet`.`insp_endline_repair`.`identity_card_id` AS `identity_card_id` from (((((`lara.jet`.`insp_endline_repair` left join `lara.jet`.`action_taken_endline_header` on(`lara.jet`.`insp_endline_repair`.`id` = `lara.jet`.`action_taken_endline_header`.`repair_id`)) left join `lara.jet`.`action_taken_endline_detail` on(`lara.jet`.`action_taken_endline_header`.`id` = `lara.jet`.`action_taken_endline_detail`.`header_id`)) join `lara.jet`.`workstations` on(`lara.jet`.`insp_endline_repair`.`workstation_id` = `lara.jet`.`workstations`.`id`)) join `lara.jet`.`workstation_locates` on(`lara.jet`.`workstations`.`workstation_locate_id` = `lara.jet`.`workstation_locates`.`id`)) join `lara.jet`.`insp_endline_defect` on(`lara.jet`.`insp_endline_repair`.`insp_endline_defect_id` = `lara.jet`.`insp_endline_defect`.`id`)) group by `lara.jet`.`insp_endline_repair`.`id`,`lara.jet`.`insp_endline_defect`.`defects_id`,`lara.jet`.`insp_endline_defect`.`check_points_id`,`lara.jet`.`insp_endline_repair`.`identity_card_id`,`lara.jet`.`insp_endline_repair`.`created_at`,`lara.jet`.`workstation_locates`.`name`,`lara.jet`.`workstations`.`name`,`lara.jet`.`insp_endline_defect`.`defects_id`,`lara.jet`.`insp_endline_defect`.`check_points_id`,`lara.jet`.`insp_endline_repair`.`identity_card_id`,`lara.jet`.`workstation_locates`.`id`,`lara.jet`.`workstation_locates`.`sort`");
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        DB::statement("DROP VIEW IF EXISTS `vw_action_taken_endline`");
    }
};
