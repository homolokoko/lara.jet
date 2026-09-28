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
        DB::statement("CREATE VIEW `vw_inline_operator_routine_per_day` AS select cast(`lara.jet`.`insp_inline_profile`.`created_at` as date) AS `report_date`,count(`lara.jet`.`insp_inline_profile`.`inspector_id`) AS `routine`,`lara.jet`.`insp_inline_profile`.`operator_id` AS `operator_id` from `lara.jet`.`insp_inline_profile` group by `lara.jet`.`insp_inline_profile`.`operator_id`,cast(`lara.jet`.`insp_inline_profile`.`created_at` as date)");
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        DB::statement("DROP VIEW IF EXISTS `vw_inline_operator_routine_per_day`");
    }
};
