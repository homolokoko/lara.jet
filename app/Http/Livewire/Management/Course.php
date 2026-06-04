<?php

namespace App\Http\Livewire\Management;

use App\Library\GetValueTextList;
use App\Models\Configure\SubjectTitle;
use App\Models\Course as CourseModel;
use App\Models\Staff;
use App\Models\User;
use Illuminate\Support\Arr;
use Illuminate\Support\Str;
use Livewire\Component;

class Course extends Component
{
    public function render()
    {
        return view('livewire.management.course');
    }

    public function load()
    {
        $staff = Staff::get()
            ->map(fn($elem)=>['value'=>$elem->id,'text'=>$elem->name_en.'('.$elem->name_kh.')'])->toArray();
        return ['staffs'=>$staff];
    }

    public function datatable($page,$per_page,$filter)
    {
        return CourseModel\Header::with('detail.staff','subjects.title')->paginate($per_page,['*'],'page',$page)->toArray();
    }

    public function submit($info,$subjects)
    {
        dd(['info'=>$info,'subjects'=>$subjects]);
        $course = CourseModel\Header::create(['name'=>Arr::get($info,'name')]);
        $detail = CourseModel\Detail::create([
            'name'=>Arr::get($info,'name'),
            'course_id'=>$course->id,
            'staff_id'=>Arr::get($info,'staff_id'),
            'class_room'=>Arr::get($info,'class_room'),
            'status'=>Arr::get($info,'status'),
            'kh_lvl'=>Arr::get($info,'kh_lvl'),
            'en_lvl'=>Arr::get($info,'en_lvl'),
            'monthly_payment'=>Arr::get($info,'monthly_payment'),
            'enroll_date'=>Arr::get($info,'enroll_date'),
            'start_course'=>Arr::get($info,'start_course'),
            'finish_course'=>Arr::get($info,'finish_course'),
            'start_session'=>Arr::get($info,'start_session'),
            'finish_session'=>Arr::get($info,'finish_session')
            ]);
        foreach($subjects as $subject):
            $title =['name'=>Str::of(Arr::get($subject,'name'))->lower()->snake()];
            $subject_title = SubjectTitle::updateOrCreate($title,$title);
            CourseModel\Subject::create([
                'course_id'=>$course->id,
                'subject_id'=>$subject_title->id,
                'max_score'=>Arr::get($subject,'max_score')
                ]);
        endforeach;
    }

    public function remove($id)
    {
        CourseModel\Header::where('id',$id)->delete();
    }

}
