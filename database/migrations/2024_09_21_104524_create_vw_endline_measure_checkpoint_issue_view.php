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
        DB::statement("CREATE VIEW `vw_endline_measure_checkpoint_issue` AS select `lara.jet`.`endline_measure_repair_header`.`id` AS `case_id`,`lara.jet`.`endline_measure_header`.`date` AS `date`,`lara.jet`.`endline_measure_repair_header`.`qrcode` AS `qrcode`,`lara.jet`.`endline_measure_header`.`locate_id` AS `locate_id`,`lara.jet`.`endline_measure_chart`.`measure_tolerance_define_id` AS `measure_tolerance_define_id`,`lara.jet`.`endline_measure_chart`.`actual` AS `actual`,`lara.jet`.`endline_measure_chart`.`actual_in_decimal` AS `actual_in_decimal`,`lara.jet`.`endline_measure_chart`.`different` AS `different`,`lara.jet`.`endline_measure_item`.`color_id` AS `color_id`,`lara.jet`.`endline_measure_item`.`size_id` AS `size_id`,`lara.jet`.`measure_profile_detail`.`pom_code` AS `pom_code`,`lara.jet`.`measure_profile_detail`.`pom_desc` AS `pom_desc`,`lara.jet`.`measure_profile_chart`.`tolerance_min` AS `tolerance_min`,`lara.jet`.`measure_profile_chart`.`tolerance_max` AS `tolerance_max`,`lara.jet`.`measure_profile_chart`.`expected_value` AS `expected_value` from ((((((`lara.jet`.`endline_measure_repair_header` join `lara.jet`.`endline_measure_item` on(`lara.jet`.`endline_measure_repair_header`.`item_id` = `lara.jet`.`endline_measure_item`.`id`)) join `lara.jet`.`endline_measure_header` on(`lara.jet`.`endline_measure_item`.`header_id` = `lara.jet`.`endline_measure_header`.`id`)) join `lara.jet`.`endline_measure_repair_chart` on(`lara.jet`.`endline_measure_repair_header`.`id` = `lara.jet`.`endline_measure_repair_chart`.`header_id`)) join `lara.jet`.`endline_measure_chart` on(`lara.jet`.`endline_measure_repair_chart`.`endline_measure_chart_id` = `lara.jet`.`endline_measure_chart`.`id` and `lara.jet`.`endline_measure_item`.`id` = `lara.jet`.`endline_measure_chart`.`inspection_measure_item_id`)) join `lara.jet`.`measure_profile_chart` on(`lara.jet`.`endline_measure_chart`.`measure_profile_chart_id` = `lara.jet`.`measure_profile_chart`.`id`)) join `lara.jet`.`measure_profile_detail` on(`lara.jet`.`measure_profile_chart`.`measure_profile_detail_id` = `lara.jet`.`measure_profile_detail`.`id`))");
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        DB::statement("DROP VIEW IF EXISTS `vw_endline_measure_checkpoint_issue`");
    }
};
