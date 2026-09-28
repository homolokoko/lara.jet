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
        DB::statement("CREATE VIEW `vw_endline_measure_defect_cause` AS select `lara.jet`.`endline_measure_defect_header`.`id` AS `id`,`lara.jet`.`endline_measure_defect_header`.`report_date` AS `report_date`,`lara.jet`.`endline_measure_defect_header`.`defect_found` AS `defect_found`,`lara.jet`.`endline_measure_defect_header`.`locate_id` AS `locate_id`,`lara.jet`.`endline_measure_defect_record`.`defect_id` AS `defect_id`,sum(`lara.jet`.`endline_measure_defect_record`.`count`) AS `defect_garment_qty` from (`lara.jet`.`endline_measure_defect_header` join `lara.jet`.`endline_measure_defect_record` on(`lara.jet`.`endline_measure_defect_header`.`id` = `lara.jet`.`endline_measure_defect_record`.`header_id`)) group by `lara.jet`.`endline_measure_defect_header`.`id`,`lara.jet`.`endline_measure_defect_header`.`defect_found`,`lara.jet`.`endline_measure_defect_header`.`locate_id`,`lara.jet`.`endline_measure_defect_record`.`defect_id`,`lara.jet`.`endline_measure_defect_header`.`report_date`");
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        DB::statement("DROP VIEW IF EXISTS `vw_endline_measure_defect_cause`");
    }
};
