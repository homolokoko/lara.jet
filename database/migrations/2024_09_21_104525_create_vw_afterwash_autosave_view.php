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
        DB::statement("CREATE VIEW `vw_afterwash_autosave` AS select max(`lara.jet`.`insp_afterwash_profile`.`id`) AS `profile_id`,max(`lara.jet`.`insp_afterwash_item`.`id`) AS `item_id`,`lara.jet`.`insp_afterwash_profile`.`inspector_id` AS `inspector_id` from (`lara.jet`.`insp_afterwash_profile` join `lara.jet`.`insp_afterwash_item` on(`lara.jet`.`insp_afterwash_profile`.`id` = `lara.jet`.`insp_afterwash_item`.`insp_profile_id`)) group by `lara.jet`.`insp_afterwash_profile`.`inspector_id`");
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        DB::statement("DROP VIEW IF EXISTS `vw_afterwash_autosave`");
    }
};
