<?php

namespace App\Http\Livewire\Management\ScoreBulletin;

use App\Library\Helper;
use App\Models\Course\Header;
use App\Models\ScoreBullet;
use App\Models\Student\Profile;
use Illuminate\Support\Arr;
use Livewire\Component;

class Create extends Component
{
    public function render()
    {
        return view('livewire.management.score-bulletin.create');
    }

    public function retrieveData()
    {
        $types = ['-','Monthly','Semester','Final'];
        $shifts = Helper::getShift();
        $months = Helper::getMonth();
        $current_year = \Carbon\Carbon::now()->year;
        $years = range($current_year,$current_year+10);
        $courses = Header::get()->map(fn($item)=>['value'=>$item->id,'text'=>$item->name])->toArray();
        $students = Profile::get()->map(fn($item)=>['value'=>$item->id,'text'=>$item->name_kh.' '.$item->name_en])->toArray();
        return ['types'=>$types,'shifts'=>$shifts,'courses'=>$courses,'students'=>$students,'months'=>$months,'years'=>$years];
    }

    public function saveItems($data)
    {
        // dd($data);
        $header = ScoreBullet\Header::create([
            'student_id'=>Arr::get($data,'student'),
            'course_id'=>Arr::get($data,'course'),
            'shift'=>Arr::get($data,'shift'),
            'presented'=>0,
            'missed'=>0,
            'type'=>Arr::get($data,'type'),
            'month'=>Arr::get($data,'month'),
            'year'=>Arr::get($data,'year'),
            'user_id'=>auth()->user()->id,
        ]);
        foreach(Arr::get($data,'subjects') as $subject):
            ScoreBullet\Subjects::create([
                'score_bullet_header_id'=>$header->id,
                'subject'=>Arr::get($subject,'subject'),
                'full_marks'=>Arr::get($subject,'full_marks'),
                'actual_marks'=>Arr::get($subject,'actual_marks')
            ])
;        endforeach;
    }
}
