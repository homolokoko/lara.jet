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
        DB::statement("CREATE VIEW `vw_develop_product_profile` AS select `lara.jet`.`develop_product_profile`.`id` AS `id`,`lara.jet`.`develop_product_profile_version`.`version` AS `version`,`lara.jet`.`develop_product_profile`.`buyer_id` AS `buyer_id`,`lara.jet`.`develop_product_profile`.`report_type` AS `report_type`,`version_editor`.`editor` AS `editor`,`lara.jet`.`develop_product_profile_version`.`created_at` AS `created_at` from ((`lara.jet`.`develop_product_profile` join `lara.jet`.`develop_product_profile_version` on(`lara.jet`.`develop_product_profile`.`id` = `lara.jet`.`develop_product_profile_version`.`profile_header_id`)) join (select `lara.jet`.`develop_product_profile_checklist`.`version_id` AS `version_id`,`lara.jet`.`develop_product_profile_checklist`.`editor` AS `editor` from `lara.jet`.`develop_product_profile_checklist` group by `lara.jet`.`develop_product_profile_checklist`.`version_id`,`lara.jet`.`develop_product_profile_checklist`.`editor`) `version_editor` on(`version_editor`.`version_id` = `lara.jet`.`develop_product_profile_version`.`id`)) where `lara.jet`.`develop_product_profile_version`.`latest` = 1");
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        DB::statement("DROP VIEW IF EXISTS `vw_develop_product_profile`");
    }
};
