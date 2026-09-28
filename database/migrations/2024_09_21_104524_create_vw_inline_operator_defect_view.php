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
        DB::statement("CREATE VIEW `vw_inline_operator_defect` AS select `lara.jet`.`insp_inline_profile`.`id` AS `inline_profile_id`,`lara.jet`.`defects`.`id` AS `defects_id`,`lara.jet`.`check_points`.`name` AS `checkpoint`,`lara.jet`.`insp_inline_defect`.`image` AS `image`,`lara.jet`.`users`.`name` AS `operator_name`,`lara.jet`.`users`.`email` AS `operator_number`,cast(`lara.jet`.`insp_inline_profile`.`created_at` as date) AS `report_date`,date_format(`lara.jet`.`insp_inline_profile`.`created_at`,'%Y%V') AS `report_week` from (((((`lara.jet`.`insp_inline_defect` join `lara.jet`.`insp_inline_item` on(`lara.jet`.`insp_inline_defect`.`insp_inline_item_id` = `lara.jet`.`insp_inline_item`.`id`)) join `lara.jet`.`insp_inline_profile` on(`lara.jet`.`insp_inline_item`.`insp_inline_profile_id` = `lara.jet`.`insp_inline_profile`.`id`)) join `lara.jet`.`defects` on(`lara.jet`.`insp_inline_defect`.`defects_id` = `lara.jet`.`defects`.`id`)) join `lara.jet`.`check_points` on(`lara.jet`.`insp_inline_defect`.`check_points_id` = `lara.jet`.`check_points`.`id`)) join `lara.jet`.`users` on(`lara.jet`.`insp_inline_profile`.`operator_id` = `lara.jet`.`users`.`id`))");
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        DB::statement("DROP VIEW IF EXISTS `vw_inline_operator_defect`");
    }
};
