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
        DB::statement("CREATE VIEW `vw_inline_operator_latest_flag` AS select `lara.jet`.`insp_inline_profile`.`id` AS `id`,cast(`lara.jet`.`insp_inline_profile`.`created_at` as date) AS `report_date`,`lara.jet`.`insp_inline_profile`.`is_red` AS `red`,`lara.jet`.`insp_inline_profile`.`is_yellow` AS `yellow`,`lara.jet`.`insp_inline_profile`.`is_green` AS `green`,`latestOperatorProfile`.`profile_id` AS `profile_id`,`latestOperatorProfile`.`operator_id` AS `operator_id`,`latestOperatorRoutinePerDay`.`routine` AS `routine`,if(`lara.jet`.`insp_inline_profile`.`sample_size_pcs` = `lara.jet`.`insp_inline_profile`.`inspected_pcs`,1,0) AS `completed` from ((`lara.jet`.`insp_inline_profile` join (select `lara.jet`.`insp_inline_profile`.`operator_id` AS `operator_id`,max(`lara.jet`.`insp_inline_profile`.`id`) AS `profile_id` from `lara.jet`.`insp_inline_profile` group by `lara.jet`.`insp_inline_profile`.`operator_id`) `latestOperatorProfile` on(`latestOperatorProfile`.`profile_id` = `lara.jet`.`insp_inline_profile`.`id`)) left join (select `vw_inline_operator_routine_per_day`.`report_date` AS `report_date`,`vw_inline_operator_routine_per_day`.`routine` AS `routine`,`vw_inline_operator_routine_per_day`.`operator_id` AS `operator_id` from `lara.jet`.`vw_inline_operator_routine_per_day`) `latestOperatorRoutinePerDay` on(`latestOperatorRoutinePerDay`.`report_date` = cast(`lara.jet`.`insp_inline_profile`.`created_at` as date) and `latestOperatorRoutinePerDay`.`operator_id` = `lara.jet`.`insp_inline_profile`.`operator_id`))");
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        DB::statement("DROP VIEW IF EXISTS `vw_inline_operator_latest_flag`");
    }
};
