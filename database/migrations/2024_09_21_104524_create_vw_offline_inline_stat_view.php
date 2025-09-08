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
        DB::statement("CREATE VIEW `vw_offline_inline_stat` AS select `lara.jet`.`users`.`id` AS `operator_id`,`lara.jet`.`users`.`name` AS `operator_name`,`lara.jet`.`users`.`email` AS `operator_no`,`lara.jet`.`insp_offline_profile`.`id` AS `profile_id`,`lara.jet`.`insp_offline_profile`.`report_date` AS `report_date`,month(`lara.jet`.`insp_offline_profile`.`report_date`) AS `report_month`,`lara.jet`.`insp_offline_profile`.`inspected_pcs` AS `inspect_pcs`,`lara.jet`.`insp_offline_profile`.`repair_pcs` AS `defect_pcs`,`lara.jet`.`insp_offline_profile`.`is_green` AS `green`,`lara.jet`.`insp_offline_profile`.`is_yellow` AS `yellow`,`lara.jet`.`insp_offline_profile`.`is_red` AS `red`,`lara.jet`.`insp_offline_profile`.`is_completed` AS `completed` from (`lara.jet`.`insp_offline_profile` join `lara.jet`.`users` on(`lara.jet`.`insp_offline_profile`.`operator_id` = `lara.jet`.`users`.`id`))");
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        DB::statement("DROP VIEW IF EXISTS `vw_offline_inline_stat`");
    }
};
