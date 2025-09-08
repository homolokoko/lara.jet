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
        DB::statement("CREATE VIEW `vw_inline_workstation_flag` AS select cast(`lara.jet`.`insp_inline_profile`.`created_at` as date) AS `report_date`,`lara.jet`.`insp_inline_profile`.`is_yellow` AS `is_yellow`,`lara.jet`.`insp_inline_profile`.`is_red` AS `is_red`,`lara.jet`.`insp_inline_profile`.`is_green` AS `is_green`,`lara.jet`.`insp_inline_profile`.`created_at` AS `date_time`,`lara.jet`.`workstations`.`name` AS `workstation`,`lara.jet`.`workstations`.`id` AS `workstation_id`,`lara.jet`.`workstation_locates`.`name` AS `locate_name`,`lara.jet`.`workstation_locates`.`id` AS `locate_id`,`lara.jet`.`insp_inline_profile`.`id` AS `id`,`lara.jet`.`insp_inline_profile`.`sample_size_pcs` AS `should_pcs`,`lara.jet`.`insp_inline_profile`.`inspected_pcs` AS `inspected_pcs`,`lara.jet`.`insp_inline_profile`.`operator_id` AS `operator_id`,`operator`.`name` AS `operator_name`,`operator`.`email` AS `operator_no`,`inspector`.`name` AS `inspector_name`,`inspector`.`email` AS `inspector_no`,`lara.jet`.`styles`.`name` AS `styles_name`,trim(`lara.jet`.`purchase_orders`.`no`) AS `purchase_orders` from ((((((((`lara.jet`.`insp_inline_profile` join `lara.jet`.`insp_inline_workstation` on(`lara.jet`.`insp_inline_profile`.`id` = `lara.jet`.`insp_inline_workstation`.`insp_inline_profile_id`)) join `lara.jet`.`workstations` on(`lara.jet`.`insp_inline_workstation`.`workstation_id` = `lara.jet`.`workstations`.`id`)) join `lara.jet`.`workstation_locates` on(`lara.jet`.`workstations`.`workstation_locate_id` = `lara.jet`.`workstation_locates`.`id`)) join `lara.jet`.`users` `operator` on(`lara.jet`.`insp_inline_profile`.`operator_id` = `operator`.`id`)) join `lara.jet`.`users` `inspector` on(`lara.jet`.`insp_inline_profile`.`inspector_id` = `inspector`.`id`)) join `lara.jet`.`style_profile` on(`lara.jet`.`insp_inline_profile`.`style_profile_id` = `lara.jet`.`style_profile`.`id`)) join `lara.jet`.`styles` on(`lara.jet`.`style_profile`.`style_id` = `lara.jet`.`styles`.`id`)) join `lara.jet`.`purchase_orders` on(`lara.jet`.`insp_inline_profile`.`purchase_order_id` = `lara.jet`.`purchase_orders`.`id`))");
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        DB::statement("DROP VIEW IF EXISTS `vw_inline_workstation_flag`");
    }
};
