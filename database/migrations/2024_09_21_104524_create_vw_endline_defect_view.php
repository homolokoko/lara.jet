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
        DB::statement("CREATE VIEW `vw_endline_defect` AS select distinct cast(`lara.jet`.`insp_endline_profile`.`created_at` as date) AS `report_date`,`lara.jet`.`defects`.`id` AS `defect_id`,`lara.jet`.`workstations`.`id` AS `workstation_id`,`lara.jet`.`check_points`.`id` AS `checkpoint_id`,`lara.jet`.`insp_endline_repair`.`id` AS `case_id`,`lara.jet`.`workstation_locates`.`id` AS `locate_id`,`lara.jet`.`insp_endline_defect`.`defect_cause_id` AS `cause_id`,`lara.jet`.`workstation_locates`.`name` AS `locate`,`lara.jet`.`check_points`.`name` AS `checkpoint`,`lara.jet`.`workstations`.`name` AS `workstation`,date_format(`lara.jet`.`insp_endline_profile`.`created_at`,'%H') AS `hourly`,`lara.jet`.`insp_endline_repair`.`is_resolve` AS `is_resolve`,`lara.jet`.`insp_endline_repair`.`created_at` AS `sent_repair`,`lara.jet`.`insp_endline_repair`.`updated_at` AS `receive_repair`,`lara.jet`.`insp_endline_repair`.`identity_card_id` AS `qrcode`,`lara.jet`.`insp_endline_defect`.`image` AS `image` from (((((((`lara.jet`.`insp_endline_profile` join `lara.jet`.`insp_endline_item` on(`lara.jet`.`insp_endline_profile`.`id` = `lara.jet`.`insp_endline_item`.`insp_endline_profile_id`)) join `lara.jet`.`insp_endline_repair` on(`lara.jet`.`insp_endline_item`.`id` = `lara.jet`.`insp_endline_repair`.`insp_endline_item_id`)) join `lara.jet`.`insp_endline_defect` on(`lara.jet`.`insp_endline_repair`.`insp_endline_defect_id` = `lara.jet`.`insp_endline_defect`.`id`)) join `lara.jet`.`defects` on(`lara.jet`.`insp_endline_defect`.`defects_id` = `lara.jet`.`defects`.`id`)) join `lara.jet`.`check_points` on(`lara.jet`.`insp_endline_defect`.`check_points_id` = `lara.jet`.`check_points`.`id`)) join `lara.jet`.`workstations` on(`lara.jet`.`insp_endline_repair`.`workstation_id` = `lara.jet`.`workstations`.`id`)) join `lara.jet`.`workstation_locates` on(`lara.jet`.`workstations`.`workstation_locate_id` = `lara.jet`.`workstation_locates`.`id`))");
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        DB::statement("DROP VIEW IF EXISTS `vw_endline_defect`");
    }
};
