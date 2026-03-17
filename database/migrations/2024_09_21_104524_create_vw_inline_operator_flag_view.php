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
        DB::statement("CREATE VIEW `vw_inline_operator_flag` AS select `lara.jet`.`insp_inline_profile`.`operator_id` AS `operator_id`,`lara.jet`.`insp_inline_profile`.`is_red` AS `is_red`,`lara.jet`.`insp_inline_profile`.`is_yellow` AS `is_yellow`,`lara.jet`.`insp_inline_profile`.`is_green` AS `is_green`,cast(`lara.jet`.`insp_inline_profile`.`created_at` as date) AS `report_date`,`lara.jet`.`insp_inline_profile`.`created_at` AS `created_at`,cast(`lara.jet`.`insp_inline_profile`.`created_at` as time) AS `time`,`operator`.`name` AS `operator_name`,`lara.jet`.`insp_inline_profile`.`id` AS `inline_id`,if(`lara.jet`.`insp_inline_profile`.`sample_size_pcs` = `lara.jet`.`insp_inline_profile`.`inspected_pcs`,1,0) AS `completed`,`lara.jet`.`workstations`.`name` AS `workstation`,`lara.jet`.`workstation_locates`.`name` AS `locate` from ((((`lara.jet`.`insp_inline_profile` join `lara.jet`.`users` `operator` on(`lara.jet`.`insp_inline_profile`.`operator_id` = `operator`.`id`)) join `lara.jet`.`insp_inline_workstation` on(`lara.jet`.`insp_inline_profile`.`id` = `lara.jet`.`insp_inline_workstation`.`insp_inline_profile_id`)) join `lara.jet`.`workstations` on(`lara.jet`.`insp_inline_workstation`.`workstation_id` = `lara.jet`.`workstations`.`id`)) join `lara.jet`.`workstation_locates` on(`lara.jet`.`workstations`.`workstation_locate_id` = `lara.jet`.`workstation_locates`.`id`)) order by `lara.jet`.`insp_inline_profile`.`created_at`");
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        DB::statement("DROP VIEW IF EXISTS `vw_inline_operator_flag`");
    }
};
