<?php


namespace App\Library;


class DateRange
{
    public static function start($start)
    {
        return \Carbon\Carbon::parse($start)->setTime(7, 0, 0);
    }

    public static function end($end)
    {
        return \Carbon\Carbon::parse($end)->addDays(1)->setTime(6, 0, 0);
    }
}
