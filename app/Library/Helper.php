<?php
namespace App\Library;

use Illuminate\Support\Str;
use Intervention\Image\Facades\Image;
use Illuminate\Support\Facades\Storage;

class Helper{

    public function getType($val=null)
    {
        $collection = collect([
            ['value'=>1,'text'=>'Monthly'],
            ['value'=>2,'text'=>'Semester'],
            ['value'=>3,'text'=>'Final']
        ]);
        if(!$val || $val===0)
            return $collection;
        return $collection->filter(fn($item)=>$item['value']===$val)->first()['text'];
    }

    public function getShift($val=null)
    {
        $collection = collect([
            ['value'=>1,'text'=>'07:30-10:30'],
            ['value'=>2,'text'=>'01:30-04:30'],
            ['value'=>3,'text'=>'05:30-06:30'],
            ['value'=>4,'text'=>'06:30-07:30'],
        ]);

        if(!$val || $val===0)
            return $collection;
        return $collection->filter(fn($item)=>$item['value']===$val)->first()['text'];
    }

    public function getDay($val=null){
        $collection = collect([
            ['value'=>1,'text'=>'Sunday'],
            ['value'=>2,'text'=>'Monday'],
            ['value'=>3,'text'=>'Tueday'],
            ['value'=>4,'text'=>'Wednesday'],
            ['value'=>5,'text'=>'Thursday'],
            ['value'=>6,'text'=>'Friday'],
            ['value'=>7,'text'=>'Saturday']
        ]);
        if(!$val || $val===0)
            return $collection;
        return $collection->filter(fn($item)=>$item['value']===$val)->first()['text'];
    }

    public function getMonth($val=null)
    {
        $collection = collect([
            ['value'=>1,'text'=>'January'],
            ['value'=>2,'text'=>'Fabrary'],
            ['value'=>3,'text'=>'March'],
            ['value'=>4,'text'=>'April'],
            ['value'=>5,'text'=>'May'],
            ['value'=>6,'text'=>'June'],
            ['value'=>7,'text'=>'July'],
            ['value'=>8,'text'=>'August'],
            ['value'=>9,'text'=>'September'],
            ['value'=>10,'text'=>'October'],
            ['value'=>11,'text'=>'November'],
            ['value'=>12,'text'=>'December'],
        ]);
        if(!$val || $val===0)
            return $collection;
        return $collection->filter(fn($item)=>$item['value']===$val)->first()['text'];
    }

    public function getYear()
    {
        $current_year = \Carbon\Carbon::now()->year;
        return range($current_year,$current_year+10);
    }

    public function getStudyPeriod()
    {
        $current_year = \Carbon\Carbon::now()->year;
        $ranges = range($current_year,$current_year+10);
        return collect($ranges)->map(fn($item)=>(($item-1).'-'.$item));
    }

}
