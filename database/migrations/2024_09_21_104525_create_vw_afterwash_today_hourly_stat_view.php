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
        DB::statement("CREATE VIEW `vw_afterwash_today_hourly_stat` AS select `lara.jet`.`insp_afterwash_profile`.`report_date` AS `report_date`,`lara.jet`.`insp_afterwash_profile`.`hour` AS `hour`,sum(distinct `lara.jet`.`insp_afterwash_profile`.`repair_pcs`) AS `defect_garment`,sum(distinct `lara.jet`.`insp_afterwash_profile`.`pass_pcs`) AS `pass_pcs`,sum(distinct `lara.jet`.`insp_afterwash_profile`.`inspected_pcs`) AS `inspected_pcs` from (`lara.jet`.`insp_afterwash_profile` left join (`lara.jet`.`insp_afterwash_item` left join `lara.jet`.`insp_afterwash_repair` on(`lara.jet`.`insp_afterwash_repair`.`insp_item_id` = `lara.jet`.`insp_afterwash_item`.`id`)) on(`lara.jet`.`insp_afterwash_profile`.`id` = `lara.jet`.`insp_afterwash_item`.`insp_profile_id`)) where `lara.jet`.`insp_afterwash_profile`.`report_date` = curdate() group by `lara.jet`.`insp_afterwash_profile`.`hour`,`lara.jet`.`insp_afterwash_profile`.`report_date`");
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        DB::statement("DROP VIEW IF EXISTS `vw_afterwash_today_hourly_stat`");
    }
};
