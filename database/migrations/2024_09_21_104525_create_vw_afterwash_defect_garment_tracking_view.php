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
        DB::statement("CREATE VIEW `vw_afterwash_defect_garment_tracking` AS select `lara.jet`.`insp_afterwash_repair`.`id` AS `id`,`lara.jet`.`insp_afterwash_repair`.`identity_card_id` AS `qrcode`,`lara.jet`.`insp_afterwash_repair`.`is_resolve` AS `is_resolve`,`lara.jet`.`insp_afterwash_defect`.`defects_id` AS `defects_id`,`lara.jet`.`insp_afterwash_defect`.`check_points_id` AS `checkpoint_id`,`lara.jet`.`insp_afterwash_defect`.`image` AS `image`,`lara.jet`.`insp_afterwash_defect`.`defect_cause_id` AS `cause_id`,`lara.jet`.`workstation_locates`.`name` AS `sent_to`,`lara.jet`.`sizes`.`name` AS `size`,`lara.jet`.`color`.`name` AS `color`,`lara.jet`.`insp_afterwash_defect`.`created_at` AS `happen`,`lara.jet`.`insp_afterwash_defect`.`updated_at` AS `return`,`lara.jet`.`styles`.`name` AS `style`,cast(`lara.jet`.`insp_afterwash_defect`.`created_at` as date) AS `report_date`,`lara.jet`.`insp_afterwash_defect`.`created_at` AS `created_at`,hour(`lara.jet`.`insp_afterwash_defect`.`created_at`) AS `hour` from (((((((`lara.jet`.`insp_afterwash_profile` join `lara.jet`.`insp_afterwash_item` on(`lara.jet`.`insp_afterwash_profile`.`id` = `lara.jet`.`insp_afterwash_item`.`insp_profile_id`)) join `lara.jet`.`insp_afterwash_repair` on(`lara.jet`.`insp_afterwash_repair`.`insp_item_id` = `lara.jet`.`insp_afterwash_item`.`id`)) join `lara.jet`.`insp_afterwash_defect` on(`lara.jet`.`insp_afterwash_defect`.`id` = `lara.jet`.`insp_afterwash_repair`.`insp_item_defect_id`)) join `lara.jet`.`workstation_locates` on(`lara.jet`.`insp_afterwash_repair`.`to_locate` = `lara.jet`.`workstation_locates`.`id`)) join `lara.jet`.`sizes` on(`lara.jet`.`insp_afterwash_item`.`sizes_id` = `lara.jet`.`sizes`.`id`)) join `lara.jet`.`color` on(`lara.jet`.`insp_afterwash_item`.`color_id` = `lara.jet`.`color`.`id`)) join `lara.jet`.`styles` on(`lara.jet`.`insp_afterwash_profile`.`styles_id` = `lara.jet`.`styles`.`id`))");
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        DB::statement("DROP VIEW IF EXISTS `vw_afterwash_defect_garment_tracking`");
    }
};
