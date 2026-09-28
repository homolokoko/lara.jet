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
        DB::statement("CREATE VIEW `vw_defect` AS select `lara.jet`.`defects`.`id` AS `id`,`en`.`name` AS `en`,`kh`.`name` AS `kh`,`cn`.`name` AS `cn` from (((`lara.jet`.`defects` left join (select `lara.jet`.`defects`.`id` AS `id`,`lara.jet`.`defects_translations`.`name` AS `name` from (`lara.jet`.`defects` join `lara.jet`.`defects_translations` on(`lara.jet`.`defects`.`id` = `lara.jet`.`defects_translations`.`defects_id`)) where `lara.jet`.`defects_translations`.`locale` = 'kh') `kh` on(`kh`.`id` = `lara.jet`.`defects`.`id`)) join (select `lara.jet`.`defects`.`id` AS `id`,`lara.jet`.`defects_translations`.`name` AS `name` from (`lara.jet`.`defects` join `lara.jet`.`defects_translations` on(`lara.jet`.`defects`.`id` = `lara.jet`.`defects_translations`.`defects_id`)) where `lara.jet`.`defects_translations`.`locale` = 'en') `en` on(`en`.`id` = `lara.jet`.`defects`.`id`)) left join (select `lara.jet`.`defects`.`id` AS `id`,`lara.jet`.`defects_translations`.`name` AS `name` from (`lara.jet`.`defects` join `lara.jet`.`defects_translations` on(`lara.jet`.`defects`.`id` = `lara.jet`.`defects_translations`.`defects_id`)) where `lara.jet`.`defects_translations`.`locale` = 'cn') `cn` on(`cn`.`id` = `lara.jet`.`defects`.`id`))");
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        DB::statement("DROP VIEW IF EXISTS `vw_defect`");
    }
};
