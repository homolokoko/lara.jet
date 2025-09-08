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
        DB::statement("CREATE VIEW `vw_endline_measure_tol` AS select `lara.jet`.`endline_measure_header`.`date` AS `date`,`lara.jet`.`styles`.`name` AS `style`,`lara.jet`.`styles`.`id` AS `style_id`,`lara.jet`.`version`.`name` AS `version`,`lara.jet`.`version`.`id` AS `version_id`,`lara.jet`.`workstation_locates`.`id` AS `locate_id`,`lara.jet`.`measure_profile_detail`.`pom_code` AS `pom_code`,`lara.jet`.`measure_profile_detail`.`pom_desc` AS `pom_desc`,`lara.jet`.`measure_tolerance_define`.`id` AS `tol_define_id`,case `lara.jet`.`measure_tolerance_define`.`is_positive` when `lara.jet`.`measure_tolerance_define`.`is_positive` = 0 then concat('-',`lara.jet`.`measure_tolerance_define`.`name`) else `lara.jet`.`measure_tolerance_define`.`name` end AS `tol_name` from (((((((((`lara.jet`.`endline_measure_chart` left join `lara.jet`.`measure_tolerance_define` on(`lara.jet`.`endline_measure_chart`.`measure_tolerance_define_id` = `lara.jet`.`measure_tolerance_define`.`id`)) left join `lara.jet`.`endline_measure_item` on(`lara.jet`.`endline_measure_chart`.`inspection_measure_item_id` = `lara.jet`.`endline_measure_item`.`id`)) left join `lara.jet`.`endline_measure_header` on(`lara.jet`.`endline_measure_item`.`header_id` = `lara.jet`.`endline_measure_header`.`id`)) left join `lara.jet`.`measure_profile_chart` on(`lara.jet`.`endline_measure_chart`.`measure_profile_chart_id` = `lara.jet`.`measure_profile_chart`.`id`)) left join `lara.jet`.`measure_profile_detail` on(`lara.jet`.`measure_profile_chart`.`measure_profile_detail_id` = `lara.jet`.`measure_profile_detail`.`id`)) left join `lara.jet`.`workstation_locates` on(`lara.jet`.`endline_measure_header`.`locate_id` = `lara.jet`.`workstation_locates`.`id`)) left join `lara.jet`.`styles` on(`lara.jet`.`endline_measure_header`.`style_id` = `lara.jet`.`styles`.`id`)) left join `lara.jet`.`measure_profile_header` on(`lara.jet`.`endline_measure_header`.`measure_profile_header_id` = `lara.jet`.`measure_profile_header`.`id`)) left join `lara.jet`.`version` on(`lara.jet`.`measure_profile_header`.`version_id` = `lara.jet`.`version`.`id`))");
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        DB::statement("DROP VIEW IF EXISTS `vw_endline_measure_tol`");
    }
};
