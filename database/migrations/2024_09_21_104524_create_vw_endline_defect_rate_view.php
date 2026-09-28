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
        DB::statement("CREATE VIEW `vw_endline_defect_rate` AS select `lara.jet`.`insp_endline_profile`.`repair_pcs` AS `repair`,`lara.jet`.`insp_endline_profile`.`inspected_pcs` AS `inspected`,date_format(`lara.jet`.`insp_endline_profile`.`created_at`,'%H') AS `hourly`,`lara.jet`.`insp_endline_profile`.`workstation_locates_id` AS `locate_id`,cast(`lara.jet`.`insp_endline_profile`.`created_at` as date) AS `report_date`,`lara.jet`.`workstation_locates`.`name` AS `locate_name` from (`lara.jet`.`insp_endline_profile` join `lara.jet`.`workstation_locates` on(`lara.jet`.`insp_endline_profile`.`workstation_locates_id` = `lara.jet`.`workstation_locates`.`id`))");
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        DB::statement("DROP VIEW IF EXISTS `vw_endline_defect_rate`");
    }
};
