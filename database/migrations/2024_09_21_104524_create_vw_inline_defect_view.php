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
        DB::statement("CREATE VIEW `vw_inline_defect` AS select cast(`lara.jet`.`insp_inline_profile`.`created_at` as date) AS `report_date`,`lara.jet`.`insp_inline_profile`.`id` AS `inline_id`,`lara.jet`.`insp_inline_item`.`id` AS `item_id`,`lara.jet`.`insp_inline_repair`.`id` AS `case_id`,`lara.jet`.`insp_inline_defect`.`defects_id` AS `defect_id`,`lara.jet`.`insp_inline_defect`.`defect_cause_id` AS `cause_id`,`lara.jet`.`insp_inline_profile`.`operator_id` AS `operator_id`,`lara.jet`.`insp_inline_item`.`sizes_id` AS `sizes_id`,`lara.jet`.`insp_inline_defect`.`check_points_id` AS `checkpoint_id`,`lara.jet`.`insp_inline_repair`.`is_resolve` AS `is_resolve`,`lara.jet`.`insp_inline_defect`.`image` AS `image`,`lara.jet`.`styles`.`name` AS `style`,`lara.jet`.`styles`.`id` AS `style_id`,`lara.jet`.`purchase_orders`.`no` AS `purchase_order`,`lara.jet`.`insp_inline_repair`.`created_at` AS `send_repair`,`lara.jet`.`insp_inline_repair`.`updated_at` AS `return_repair`,`lara.jet`.`sizes`.`name` AS `sizes`,`lara.jet`.`check_points`.`name` AS `checkpoint` from ((((((((`lara.jet`.`insp_inline_repair` join `lara.jet`.`insp_inline_item` on(`lara.jet`.`insp_inline_repair`.`insp_inline_item_id` = `lara.jet`.`insp_inline_item`.`id`)) join `lara.jet`.`insp_inline_defect` on(`lara.jet`.`insp_inline_repair`.`insp_inline_defect_id` = `lara.jet`.`insp_inline_defect`.`id`)) join `lara.jet`.`insp_inline_profile` on(`lara.jet`.`insp_inline_item`.`insp_inline_profile_id` = `lara.jet`.`insp_inline_profile`.`id`)) join `lara.jet`.`purchase_orders` on(`lara.jet`.`insp_inline_profile`.`purchase_order_id` = `lara.jet`.`purchase_orders`.`id`)) join `lara.jet`.`style_profile` on(`lara.jet`.`insp_inline_defect`.`style_profile_id` = `lara.jet`.`style_profile`.`id`)) join `lara.jet`.`styles` on(`lara.jet`.`style_profile`.`style_id` = `lara.jet`.`styles`.`id`)) join `lara.jet`.`sizes` on(`lara.jet`.`insp_inline_item`.`sizes_id` = `lara.jet`.`sizes`.`id`)) join `lara.jet`.`check_points` on(`lara.jet`.`insp_inline_defect`.`check_points_id` = `lara.jet`.`check_points`.`id`))");
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        DB::statement("DROP VIEW IF EXISTS `vw_inline_defect`");
    }
};
