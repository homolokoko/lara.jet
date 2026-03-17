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
        DB::statement("CREATE VIEW `vw_endline_measure_checkpoint_history` AS select `lara.jet`.`measure_profile_detail`.`pom_code` AS `pom_code`,`lara.jet`.`measure_profile_detail`.`pom_desc` AS `pom_desc`,`lara.jet`.`measure_profile_detail`.`id` AS `checkpoint_id`,`lara.jet`.`measure_profile_chart`.`tolerance_min` AS `tolerance_min`,`lara.jet`.`measure_profile_chart`.`tolerance_max` AS `tolerance_max`,`lara.jet`.`measure_profile_chart`.`expected_value` AS `expected_value`,`lara.jet`.`endline_measure_chart`.`inspection_measure_item_id` AS `inspection_measure_item_id`,`lara.jet`.`endline_measure_chart`.`measure_profile_chart_id` AS `measure_profile_chart_id`,`lara.jet`.`endline_measure_item`.`color_id` AS `color_id`,`lara.jet`.`endline_measure_item`.`size_id` AS `size_id`,`lara.jet`.`endline_measure_header`.`style_id` AS `style_id`,`lara.jet`.`endline_measure_header`.`locate_id` AS `locate_id`,`lara.jet`.`endline_measure_header`.`inspector_id` AS `inspector_id`,`lara.jet`.`endline_measure_header`.`purchase_orders_id` AS `purchase_orders_id`,`lara.jet`.`endline_measure_item`.`created_at` AS `created_at`,`lara.jet`.`sizes`.`name` AS `size_name`,`lara.jet`.`color`.`name` AS `color_name`,`lara.jet`.`users`.`name` AS `inspector_name`,`lara.jet`.`users`.`email` AS `inspector_number`,`lara.jet`.`endline_measure_chart`.`id` AS `id`,`lara.jet`.`endline_measure_chart`.`actual` AS `actual`,`lara.jet`.`endline_measure_chart`.`actual_in_decimal` AS `actual_decimal`,`lara.jet`.`endline_measure_chart`.`different` AS `different`,`lara.jet`.`endline_measure_chart`.`is_less` AS `actual_less`,`lara.jet`.`endline_measure_chart`.`is_tally` AS `actual_tally`,`lara.jet`.`endline_measure_chart`.`is_more` AS `actual_more`,`lara.jet`.`endline_measure_chart`.`is_accept` AS `actual_accept` from (((((((`lara.jet`.`endline_measure_header` join `lara.jet`.`endline_measure_item` on(`lara.jet`.`endline_measure_header`.`id` = `lara.jet`.`endline_measure_item`.`header_id`)) join `lara.jet`.`endline_measure_chart` on(`lara.jet`.`endline_measure_item`.`id` = `lara.jet`.`endline_measure_chart`.`inspection_measure_item_id`)) join `lara.jet`.`measure_profile_chart` on(`lara.jet`.`endline_measure_chart`.`measure_profile_chart_id` = `lara.jet`.`measure_profile_chart`.`id`)) join `lara.jet`.`measure_profile_detail` on(`lara.jet`.`measure_profile_chart`.`measure_profile_detail_id` = `lara.jet`.`measure_profile_detail`.`id`)) join `lara.jet`.`sizes` on(`lara.jet`.`endline_measure_item`.`size_id` = `lara.jet`.`sizes`.`id`)) join `lara.jet`.`color` on(`lara.jet`.`endline_measure_item`.`color_id` = `lara.jet`.`color`.`id`)) join `lara.jet`.`users` on(`lara.jet`.`endline_measure_header`.`inspector_id` = `lara.jet`.`users`.`id`))");
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        DB::statement("DROP VIEW IF EXISTS `vw_endline_measure_checkpoint_history`");
    }
};
