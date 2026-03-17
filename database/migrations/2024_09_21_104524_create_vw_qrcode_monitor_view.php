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
        DB::statement("CREATE VIEW `vw_qrcode_monitor` AS select `lara.jet`.`identity_card`.`id` AS `id`,`lara.jet`.`identity_card`.`is_occupied` AS `is_occupied`,`lara.jet`.`identity_card_monitor`.`locate_from` AS `locate_from`,`lara.jet`.`identity_card_monitor`.`locate_to` AS `locate_to`,`lara.jet`.`identity_card_monitor`.`model` AS `model`,`lara.jet`.`identity_card_monitor`.`created_at` AS `created_at`,`lara.jet`.`identity_card_monitor`.`updated_at` AS `updated_at` from (`lara.jet`.`identity_card` join `lara.jet`.`identity_card_monitor` on(`lara.jet`.`identity_card`.`id` = `lara.jet`.`identity_card_monitor`.`identity_card_id`)) order by `lara.jet`.`identity_card`.`id`");
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        DB::statement("DROP VIEW IF EXISTS `vw_qrcode_monitor`");
    }
};
