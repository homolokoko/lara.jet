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
        DB::statement("CREATE VIEW `vw_endline_measure_report` AS select cast(`lara.jet`.`endline_measure_item`.`created_at` as date) AS `report_date`,`lara.jet`.`endline_measure_header`.`locate_id` AS `locate_id`,`lara.jet`.`endline_measure_item`.`size_id` AS `size_id`,`lara.jet`.`endline_measure_item`.`color_id` AS `color_id`,`lara.jet`.`endline_measure_item`.`id` AS `item_id`,`lara.jet`.`measure_profile_detail`.`id` AS `measurement_point_id`,`lara.jet`.`endline_measure_chart`.`different` AS `different`,`lara.jet`.`endline_measure_chart`.`is_less` AS `is_less`,`lara.jet`.`endline_measure_chart`.`is_tally` AS `is_tally`,`lara.jet`.`endline_measure_chart`.`is_more` AS `is_more`,case when `lara.jet`.`endline_measure_chart`.`different` >= 0 and `lara.jet`.`endline_measure_chart`.`different` < 1 and 0 <> `lara.jet`.`endline_measure_chart`.`is_less` then 1 when `lara.jet`.`endline_measure_chart`.`different` >= 0 and `lara.jet`.`endline_measure_chart`.`different` < 1 and 0 <> `lara.jet`.`endline_measure_chart`.`is_tally` then 1 else 0 end AS `pass`,`lara.jet`.`styles`.`id` AS `style_id` from ((((((`lara.jet`.`styles` join `lara.jet`.`measure_profile_header` on(`lara.jet`.`styles`.`id` = `lara.jet`.`measure_profile_header`.`styles_id`)) join `lara.jet`.`measure_profile_detail` on(`lara.jet`.`measure_profile_header`.`id` = `lara.jet`.`measure_profile_detail`.`measure_profile_header_id`)) join `lara.jet`.`measure_profile_chart` on(`lara.jet`.`measure_profile_detail`.`id` = `lara.jet`.`measure_profile_chart`.`measure_profile_detail_id`)) join `lara.jet`.`endline_measure_chart` on(`lara.jet`.`measure_profile_chart`.`id` = `lara.jet`.`endline_measure_chart`.`measure_profile_chart_id`)) join `lara.jet`.`endline_measure_item` on(`lara.jet`.`endline_measure_chart`.`inspection_measure_item_id` = `lara.jet`.`endline_measure_item`.`id`)) join `lara.jet`.`endline_measure_header` on(`lara.jet`.`endline_measure_item`.`header_id` = `lara.jet`.`endline_measure_header`.`id`))");
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        DB::statement("DROP VIEW IF EXISTS `vw_endline_measure_report`");
    }
};
