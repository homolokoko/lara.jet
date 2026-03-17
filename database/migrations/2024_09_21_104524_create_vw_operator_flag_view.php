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
        DB::statement("CREATE VIEW `vw_operator_flag` AS select `lara.jet`.`insp_inline_profile`.`operator_id` AS `operator_id`,`lara.jet`.`insp_inline_profile`.`is_red` AS `is_red`,`lara.jet`.`insp_inline_profile`.`is_yellow` AS `is_yellow`,`lara.jet`.`insp_inline_profile`.`is_green` AS `is_green`,cast(`lara.jet`.`insp_inline_profile`.`created_at` as date) AS `report_date`,`operator`.`name` AS `operator_name` from (`lara.jet`.`insp_inline_profile` join `lara.jet`.`users` `operator` on(`lara.jet`.`insp_inline_profile`.`operator_id` = `operator`.`id`))");
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        DB::statement("DROP VIEW IF EXISTS `vw_operator_flag`");
    }
};
