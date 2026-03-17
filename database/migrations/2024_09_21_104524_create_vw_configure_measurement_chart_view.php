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
        DB::statement("CREATE VIEW `vw_configure_measurement_chart` AS select `lara.jet`.`measure_profile_header`.`id` AS `header_id`,`lara.jet`.`measure_profile_header`.`styles_id` AS `styles_id`,`lara.jet`.`measure_profile_header`.`version_id` AS `version_id`,`lara.jet`.`measure_profile_detail`.`pom_code` AS `pom_code`,`lara.jet`.`measure_profile_detail`.`pom_desc` AS `pom_desc`,`lara.jet`.`measure_profile_chart`.`sizes_id` AS `size_id`,`lara.jet`.`measure_profile_chart`.`tolerance_min` AS `tol_min`,`lara.jet`.`measure_profile_chart`.`tolerance_max` AS `tol_max`,`lara.jet`.`measure_profile_chart`.`expected_value` AS `expected`,`lara.jet`.`measure_profile_chart`.`id` AS `id`,`lara.jet`.`measure_profile_detail`.`id` AS `checkpoint_id` from (((`lara.jet`.`measure_profile_header` join `lara.jet`.`measure_profile_detail` on(`lara.jet`.`measure_profile_header`.`id` = `lara.jet`.`measure_profile_detail`.`measure_profile_header_id`)) join `lara.jet`.`measure_profile_color` on(`lara.jet`.`measure_profile_header`.`id` = `lara.jet`.`measure_profile_color`.`header_id`)) join `lara.jet`.`measure_profile_chart` on(`lara.jet`.`measure_profile_detail`.`id` = `lara.jet`.`measure_profile_chart`.`measure_profile_detail_id`)) where `lara.jet`.`measure_profile_chart`.`deleted_at` is null and `lara.jet`.`measure_profile_detail`.`deleted_at` is null and `lara.jet`.`measure_profile_header`.`deleted_at` is null");
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        DB::statement("DROP VIEW IF EXISTS `vw_configure_measurement_chart`");
    }
};
