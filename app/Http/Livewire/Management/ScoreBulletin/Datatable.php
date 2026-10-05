<?php

namespace App\Http\Livewire\Management\ScoreBulletin;

use App\Library\GetValueTextList;
use App\Library\Helper;
use App\Models\Course\Header as Course;
use App\Models\ScoreBullet\Header;
use App\Models\Student\Profile;
use Illuminate\Support\Arr;
use Illuminate\Support\Facades\Date;
use Livewire\Component;

class Datatable extends Component
{
    public function render()
    {
        return view('livewire.management.score-bulletin.datatable');
    }

    public function retrievedata($page,$perpage,$filter)
    {
        $query = Header::with('student','course');
        if(!empty(Arr::get($filter,'name')) && Arr::get($filter,'name') != ""){
            $students = Profile::where('name_en','like','%'.Arr::get($filter,'name').'%');
            $query->whereIn('student_id',$students->pluck('id')->toArray());
        }
        if(!empty(Arr::get($filter,'course')) && Arr::get($filter,'course') != ""){
            $query->where('course_id', Arr::get($filter,'course'));
        }
        if(!empty(Arr::get($filter,'type')) && Arr::get($filter,'type') != ""){
            $query->where('type', Arr::get($filter,'type'));
        }
        if(!empty(Arr::get($filter,'month')) && Arr::get($filter,'month') != ""){
            $query->where('month', Arr::get($filter,'month'));
        }
        if(!empty(Arr::get($filter,'year')) && Arr::get($filter,'year') != ""){
            $query->where('year', Arr::get($filter,'year'));
        }
        if(!empty(Arr::get($filter,'shift')) && Arr::get($filter,'shift') != ""){
            $query->where('shift', Arr::get($filter,'shift'));
        }

        return $query->paginate($perpage,['*'],'page',$page)->toArray();
    }

    public function getSourceFilter()
    {
        $types = ['-','Monthly','Semester','Final'];
        $shifts = Helper::getShift();
        $months = Helper::getMonth();
        $current_year = Date::now()->year;
        $years = range($current_year-10, $current_year+10);
        $courses = (new GetValueTextList)->convert(Course::get());
        return ['shifts'=>$shifts,'courses'=>$courses,'months'=>$months,'types'=>$types,'years'=>$years];
    }

    public function deleteItem($id)
    {
        Header::where('id',$id)->delete();
    }
}
