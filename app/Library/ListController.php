<?php
namespace App\Library;

class ListController
{
    public static function mapping($first)
    {
        return ['value'=>$first->id, 'text'=>$first->name];
    }

    public static function generate($list)
    {
        return $list->map(fn($item)=>['value'=>$item->id,'text'=>$item->name])->toArray();
    }
}
