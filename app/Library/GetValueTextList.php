<?php
namespace App\Library;

class GetValueTextList
{
    public static function mapping($first)
    {
        return ['value'=>$first->id, 'text'=>$first->name];
    }

    public static function convert($list)
    {
        return $list->map(fn($item)=>['value'=>$item->id,'text'=>$item->name])->toArray();
    }
}
