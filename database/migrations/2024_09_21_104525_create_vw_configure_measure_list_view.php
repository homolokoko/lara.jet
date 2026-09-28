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
        DB::statement("CREATE VIEW `vw_configure_measure_list` AS select `lara.jet`.`measure_profile_header`.`styles_id` AS `styles_id`,group_concat(distinct `lara.jet`.`measure_profile_header`.`id` separator ',') AS `header_list`,group_concat(distinct `lara.jet`.`measure_profile_header`.`version_id` separator ',') AS `version_list`,group_concat(distinct `lara.jet`.`measure_profile_color`.`color_id` separator ',') AS `color_list`,group_concat(distinct `lara.jet`.`measure_profile_chart`.`sizes_id` separator ',') AS `sizes_list`,`lara.jet`.`measure_profile_header`.`id` AS `id` from ((((`lara.jet`.`measure_profile_header` join `lara.jet`.`version` on(`lara.jet`.`measure_profile_header`.`version_id` = `lara.jet`.`version`.`id`)) join `lara.jet`.`measure_profile_color` on(`lara.jet`.`measure_profile_header`.`id` = `lara.jet`.`measure_profile_color`.`header_id`)) join `lara.jet`.`measure_profile_detail` on(`lara.jet`.`measure_profile_header`.`id` = `lara.jet`.`measure_profile_detail`.`measure_profile_header_id`)) join `lara.jet`.`measure_profile_chart` on(`lara.jet`.`measure_profile_detail`.`id` = `lara.jet`.`measure_profile_chart`.`measure_profile_detail_id`)) where `lara.jet`.`measure_profile_header`.`deleted_at` is null group by `lara.jet`.`measure_profile_header`.`styles_id`,`lara.jet`.`measure_profile_header`.`id`");
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        DB::statement("DROP VIEW IF EXISTS `vw_configure_measure_list`");
    }
};
