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
        DB::statement("CREATE VIEW `vw_endline_measure_defect_rate` AS select `main_tbl`.`report_date` AS `report_date`,`main_tbl`.`locate_id` AS `locate_id`,`main_tbl`.`hour` AS `hour`,ifnull(`garment_check`.`inspect_qty`,`garment_defect`.`defect_found`) AS `inspect_qty`,ifnull(`garment_defect`.`defect_found`,0) AS `defect_found` from ((((select `lara.jet`.`endline_measure_defect_header`.`report_date` AS `report_date`,`lara.jet`.`endline_measure_defect_header`.`locate_id` AS `locate_id`,hour(`lara.jet`.`endline_measure_defect_header`.`created_at`) AS `hour` from `lara.jet`.`endline_measure_defect_header` group by `lara.jet`.`endline_measure_defect_header`.`report_date`,`lara.jet`.`endline_measure_defect_header`.`locate_id`,`lara.jet`.`endline_measure_defect_header`.`created_at`) union select `lara.jet`.`endline_measure_header`.`date` AS `report_date`,`lara.jet`.`endline_measure_header`.`locate_id` AS `locate`,hour(`lara.jet`.`endline_measure_header`.`created_at`) AS `hour` from `lara.jet`.`endline_measure_header` group by `lara.jet`.`endline_measure_header`.`date`,`lara.jet`.`endline_measure_header`.`locate_id`,hour(`lara.jet`.`endline_measure_header`.`created_at`)) `main_tbl` left join (select `inspect_garment`.`report_date` AS `report_date`,`inspect_garment`.`locate` AS `locate_id`,`inspect_garment`.`hour` AS `hour`,sum(`inspect_garment`.`inspect_qty`) AS `inspect_qty` from (select `lara.jet`.`endline_measure_header`.`date` AS `report_date`,`lara.jet`.`endline_measure_header`.`locate_id` AS `locate`,hour(`lara.jet`.`endline_measure_header`.`created_at`) AS `hour`,sum(`lara.jet`.`endline_measure_header`.`inspected_garment_qty`) AS `inspect_qty` from `lara.jet`.`endline_measure_header` group by `lara.jet`.`endline_measure_header`.`date`,`lara.jet`.`endline_measure_header`.`locate_id`,hour(`lara.jet`.`endline_measure_header`.`created_at`) order by `lara.jet`.`endline_measure_header`.`locate_id`) `inspect_garment` group by `inspect_garment`.`report_date`,`inspect_garment`.`locate`,`inspect_garment`.`hour`) `garment_check` on(`garment_check`.`report_date` = `main_tbl`.`report_date` and `garment_check`.`locate_id` = `main_tbl`.`locate_id` and `garment_check`.`hour` = `main_tbl`.`hour`)) left join (select `lara.jet`.`endline_measure_defect_header`.`report_date` AS `report_date`,hour(`lara.jet`.`endline_measure_defect_header`.`created_at`) AS `hour`,`lara.jet`.`endline_measure_defect_header`.`locate_id` AS `locate_id`,sum(`lara.jet`.`endline_measure_defect_header`.`defect_found`) AS `defect_found` from `lara.jet`.`endline_measure_defect_header` group by `lara.jet`.`endline_measure_defect_header`.`report_date`,hour(`lara.jet`.`endline_measure_defect_header`.`created_at`),`lara.jet`.`endline_measure_defect_header`.`locate_id`) `garment_defect` on(`garment_defect`.`report_date` = `main_tbl`.`report_date` and `garment_defect`.`locate_id` = `main_tbl`.`locate_id` and `garment_defect`.`hour` = `main_tbl`.`hour`))");
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        DB::statement("DROP VIEW IF EXISTS `vw_endline_measure_defect_rate`");
    }
};
