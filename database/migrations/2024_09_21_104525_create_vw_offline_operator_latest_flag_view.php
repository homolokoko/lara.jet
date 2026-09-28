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
        DB::statement("CREATE VIEW `vw_offline_operator_latest_flag` AS select `lara.jet`.`insp_offline_profile`.`id` AS `id`,`lara.jet`.`insp_offline_profile`.`report_date` AS `report_date`,`lara.jet`.`insp_offline_profile`.`is_red` AS `red`,`lara.jet`.`insp_offline_profile`.`is_yellow` AS `yellow`,`lara.jet`.`insp_offline_profile`.`is_green` AS `green`,`latestOperatorProfile`.`profile_id` AS `profiles_id`,`latestOperatorProfile`.`operator_id` AS `operator_id`,`latestOperatorRoutinePerDay`.`routine` AS `routine`,`lara.jet`.`insp_offline_profile`.`is_completed` AS `completed` from ((`lara.jet`.`insp_offline_profile` join (select `lara.jet`.`insp_offline_profile`.`operator_id` AS `operator_id`,max(`lara.jet`.`insp_offline_profile`.`id`) AS `profile_id` from `lara.jet`.`insp_offline_profile` group by `lara.jet`.`insp_offline_profile`.`operator_id`) `latestOperatorProfile` on(`latestOperatorProfile`.`profile_id` = `lara.jet`.`insp_offline_profile`.`id`)) left join (select `vw_offline_operator_routine_per_day`.`report_date` AS `report_date`,`vw_offline_operator_routine_per_day`.`routine` AS `routine`,`vw_offline_operator_routine_per_day`.`operator_id` AS `operator_id` from `lara.jet`.`vw_offline_operator_routine_per_day`) `latestOperatorRoutinePerDay` on(`latestOperatorRoutinePerDay`.`report_date` = `lara.jet`.`insp_offline_profile`.`report_date` and `latestOperatorRoutinePerDay`.`operator_id` = `lara.jet`.`insp_offline_profile`.`operator_id`))");
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        DB::statement("DROP VIEW IF EXISTS `vw_offline_operator_latest_flag`");
    }
};
