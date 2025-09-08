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
        DB::statement("CREATE VIEW `vw_endline_hotmap` AS select `lara.jet`.`style_profile_check_points`.`number` AS `area`,`lara.jet`.`style_profile_apparels`.`id` AS `sketch`,`lara.jet`.`check_points`.`id` AS `checkpoint_id`,`lara.jet`.`check_points`.`name` AS `checkpoint`,cast(`lara.jet`.`insp_endline_repair`.`created_at` as date) AS `report_date`,`lara.jet`.`workstation_locates`.`name` AS `locate`,`lara.jet`.`workstation_locates`.`id` AS `locate_id`,`lara.jet`.`styles_apperals`.`image` AS `sketchUrl`,`lara.jet`.`insp_endline_repair`.`insp_endline_item_id` AS `item_id`,`lara.jet`.`style_profile`.`deleted_at` AS `deleted_at`,`lara.jet`.`style_profile_apparels`.`id` AS `style_profile_apparels_id` from ((((((((`lara.jet`.`insp_endline_defect` join `lara.jet`.`style_profile` on(`lara.jet`.`insp_endline_defect`.`style_profile_id` = `lara.jet`.`style_profile`.`id`)) join `lara.jet`.`style_profile_apparels` on(`lara.jet`.`style_profile`.`id` = `lara.jet`.`style_profile_apparels`.`style_profile_id`)) join `lara.jet`.`style_profile_check_points` on(`lara.jet`.`style_profile_apparels`.`id` = `lara.jet`.`style_profile_check_points`.`style_profile_apparels_id`)) join `lara.jet`.`check_points` on(`lara.jet`.`insp_endline_defect`.`check_points_id` = `lara.jet`.`check_points`.`id` and `lara.jet`.`style_profile_check_points`.`check_points_id` = `lara.jet`.`check_points`.`id`)) join `lara.jet`.`insp_endline_repair` on(`lara.jet`.`insp_endline_defect`.`id` = `lara.jet`.`insp_endline_repair`.`insp_endline_defect_id`)) join `lara.jet`.`workstations` on(`lara.jet`.`insp_endline_repair`.`workstation_id` = `lara.jet`.`workstations`.`id`)) join `lara.jet`.`workstation_locates` on(`lara.jet`.`workstations`.`workstation_locate_id` = `lara.jet`.`workstation_locates`.`id`)) join `lara.jet`.`styles_apperals` on(`lara.jet`.`style_profile_apparels`.`styles_apparels_id` = `lara.jet`.`styles_apperals`.`id`)) where `lara.jet`.`style_profile`.`deleted_at` is null and `lara.jet`.`styles_apperals`.`deleted_at` is null");
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        DB::statement("DROP VIEW IF EXISTS `vw_endline_hotmap`");
    }
};
