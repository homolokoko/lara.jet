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
        DB::statement("CREATE VIEW `vw_quality_endline_measurement` AS select `lara.jet`.`styles`.`name` AS `IA Number`,`lara.jet`.`endline_measure_header`.`date` AS `date`,`lara.jet`.`measure_profile_detail`.`pom_code` AS `pom_code`,`lara.jet`.`measure_profile_detail`.`pom_desc` AS `pom_desc`,trim(`lara.jet`.`color`.`name`) AS `color`,trim(`lara.jet`.`sizes`.`name`) AS `size`,count(`lara.jet`.`endline_measure_item`.`header_id`) AS `Inspected Qty`,sum(case when `lara.jet`.`endline_measure_chart`.`different` >= 0 and `lara.jet`.`endline_measure_chart`.`different` < 1 and `lara.jet`.`endline_measure_chart`.`is_less` <> 0 then 1 when `lara.jet`.`endline_measure_chart`.`different` >= 0 and `lara.jet`.`endline_measure_chart`.`different` < 1 and `lara.jet`.`endline_measure_chart`.`is_tally` <> 0 then 1 else 0 end) AS `Pass`,sum(case when `lara.jet`.`endline_measure_chart`.`different` >= 1 and `lara.jet`.`endline_measure_chart`.`is_less` <> 0 then 1 when `lara.jet`.`endline_measure_chart`.`different` > 0 and `lara.jet`.`endline_measure_chart`.`is_more` <> 0 then 1 else 0 end) AS `Fail` from ((((((`lara.jet`.`styles` join `lara.jet`.`endline_measure_header` on(`lara.jet`.`styles`.`id` = `lara.jet`.`endline_measure_header`.`style_id`)) join `lara.jet`.`endline_measure_chart`) join `lara.jet`.`measure_profile_detail` on(`lara.jet`.`endline_measure_chart`.`measure_profile_chart_id` = `lara.jet`.`measure_profile_detail`.`id`)) join `lara.jet`.`endline_measure_item` on(`lara.jet`.`endline_measure_chart`.`inspection_measure_item_id` = `lara.jet`.`endline_measure_item`.`id` and `lara.jet`.`endline_measure_header`.`id` = `lara.jet`.`endline_measure_item`.`header_id`)) join `lara.jet`.`sizes` on(`lara.jet`.`endline_measure_item`.`size_id` = `lara.jet`.`sizes`.`id`)) join `lara.jet`.`color` on(`lara.jet`.`endline_measure_item`.`color_id` = `lara.jet`.`color`.`id`)) where `lara.jet`.`endline_measure_chart`.`is_valid` = 1 group by `lara.jet`.`styles`.`name`,`lara.jet`.`endline_measure_header`.`date`,`lara.jet`.`endline_measure_item`.`color_id`,`lara.jet`.`endline_measure_item`.`size_id`");
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        DB::statement("DROP VIEW IF EXISTS `vw_quality_endline_measurement`");
    }
};
