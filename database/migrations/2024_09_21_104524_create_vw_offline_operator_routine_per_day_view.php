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
        DB::statement("CREATE VIEW `vw_offline_operator_routine_per_day` AS select `lara.jet`.`insp_offline_profile`.`report_date` AS `report_date`,count(`lara.jet`.`insp_offline_profile`.`operator_id`) AS `routine`,`lara.jet`.`insp_offline_profile`.`operator_id` AS `operator_id` from `lara.jet`.`insp_offline_profile` group by `lara.jet`.`insp_offline_profile`.`operator_id`,`lara.jet`.`insp_offline_profile`.`report_date`");
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        DB::statement("DROP VIEW IF EXISTS `vw_offline_operator_routine_per_day`");
    }
};
