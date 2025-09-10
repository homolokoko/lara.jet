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
        DB::statement("CREATE VIEW `vw_action_taken_endline_measure` AS select `lara.jet`.`endline_measure_header`.`id` AS `endline_measure_header_id`,`lara.jet`.`endline_measure_header`.`date` AS `report_date`,`lara.jet`.`endline_measure_header`.`style_id` AS `style_id`,`lara.jet`.`endline_measure_header`.`locate_id` AS `locate_id`,`lara.jet`.`endline_measure_item`.`color_id` AS `color_id`,`lara.jet`.`endline_measure_item`.`size_id` AS `size_id`,`lara.jet`.`endline_measure_repair_header`.`id` AS `case`,`lara.jet`.`endline_measure_repair_header`.`qrcode` AS `qrcode`,if(count(`lara.jet`.`action_taken_endline_measure_header`.`id`) = 0 or count(`lara.jet`.`action_taken_endline_measure_detail`.`id`) = 0,1,0) AS `action_taken`,group_concat(' ',`lara.jet`.`measure_profile_detail`.`pom_code`,'.',`lara.jet`.`measure_profile_detail`.`pom_desc` separator ',') AS `checkpoint`,group_concat(`lara.jet`.`endline_measure_chart`.`actual` separator ',') AS `actual`,group_concat(`lara.jet`.`endline_measure_chart`.`different` separator ',') AS `different`,group_concat(`lara.jet`.`endline_measure_chart`.`is_less` separator ',') AS `actual_is_less`,group_concat(`lara.jet`.`measure_profile_chart`.`expected_value` separator ',') AS `expected`,group_concat(`lara.jet`.`measure_profile_chart`.`tolerance_max` separator ',') AS `tolerance_min`,group_concat(`lara.jet`.`measure_profile_chart`.`tolerance_min` separator ',') AS `tolerance_max`,`lara.jet`.`endline_measure_item`.`id` AS `item_id`,`lara.jet`.`styles`.`name` AS `style`,`lara.jet`.`color`.`name` AS `color`,`lara.jet`.`buyers`.`name` AS `buyer`,`lara.jet`.`sizes`.`name` AS `size`,`lara.jet`.`workstation_locates`.`name` AS `locate`,`lara.jet`.`endline_measure_item`.`created_at` AS `happen` from (((((((((((((`lara.jet`.`endline_measure_repair_header` left join `lara.jet`.`action_taken_endline_measure_header` on(`lara.jet`.`endline_measure_repair_header`.`id` = `lara.jet`.`action_taken_endline_measure_header`.`repair_id`)) left join `lara.jet`.`action_taken_endline_measure_detail` on(`lara.jet`.`action_taken_endline_measure_header`.`id` = `lara.jet`.`action_taken_endline_measure_detail`.`header_id`)) join `lara.jet`.`endline_measure_item` on(`lara.jet`.`endline_measure_repair_header`.`item_id` = `lara.jet`.`endline_measure_item`.`id`)) join `lara.jet`.`endline_measure_chart` on(`lara.jet`.`endline_measure_item`.`id` = `lara.jet`.`endline_measure_chart`.`inspection_measure_item_id`)) join `lara.jet`.`endline_measure_repair_chart` on(`lara.jet`.`endline_measure_chart`.`id` = `lara.jet`.`endline_measure_repair_chart`.`endline_measure_chart_id` and `lara.jet`.`endline_measure_repair_header`.`id` = `lara.jet`.`endline_measure_repair_chart`.`header_id`)) join `lara.jet`.`measure_profile_chart` on(`lara.jet`.`endline_measure_chart`.`measure_profile_chart_id` = `lara.jet`.`measure_profile_chart`.`id`)) join `lara.jet`.`measure_profile_detail` on(`lara.jet`.`measure_profile_chart`.`measure_profile_detail_id` = `lara.jet`.`measure_profile_detail`.`id`)) join `lara.jet`.`endline_measure_header` on(`lara.jet`.`endline_measure_item`.`header_id` = `lara.jet`.`endline_measure_header`.`id`)) join `lara.jet`.`styles` on(`lara.jet`.`endline_measure_header`.`style_id` = `lara.jet`.`styles`.`id`)) join `lara.jet`.`color` on(`lara.jet`.`endline_measure_item`.`color_id` = `lara.jet`.`color`.`id`)) join `lara.jet`.`buyers` on(`lara.jet`.`styles`.`buyers_id` = `lara.jet`.`buyers`.`id`)) join `lara.jet`.`sizes` on(`lara.jet`.`endline_measure_item`.`size_id` = `lara.jet`.`sizes`.`id`)) join `lara.jet`.`workstation_locates` on(`lara.jet`.`workstation_locates`.`id` = `lara.jet`.`endline_measure_header`.`locate_id`)) where `lara.jet`.`action_taken_endline_measure_detail`.`deleted_at` is null group by `lara.jet`.`endline_measure_header`.`id`,`lara.jet`.`endline_measure_repair_header`.`id`,`lara.jet`.`endline_measure_header`.`date`,`lara.jet`.`endline_measure_header`.`style_id`,`lara.jet`.`endline_measure_header`.`locate_id`,`lara.jet`.`endline_measure_item`.`color_id`,`lara.jet`.`endline_measure_item`.`size_id`,`lara.jet`.`endline_measure_item`.`id`,`lara.jet`.`styles`.`name`,`lara.jet`.`color`.`name`,`lara.jet`.`buyers`.`name`,`lara.jet`.`sizes`.`name`,`lara.jet`.`workstation_locates`.`name`,`lara.jet`.`endline_measure_repair_header`.`qrcode`,`lara.jet`.`endline_measure_item`.`created_at`");
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        DB::statement("DROP VIEW IF EXISTS `vw_action_taken_endline_measure`");
    }
};
