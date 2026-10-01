<?php

namespace App\Http\Livewire\Management\Tuition;

use App\Models\Course\Header;
use App\Models\Staff;
use App\Models\Staff\User;
use App\Models\Student\Profile;
use App\Models\Tuition\{Info,Detail};
use Error;
use Illuminate\Support\Arr;
use Livewire\Component;

class Create extends Component
{
    public function render()
    {
        return view('livewire.management.tuition.create');
    }

    public function pullData()
    {
        $courses = Header::get()->map(fn($item)=>['value'=>$item->id,'text'=>$item->name]);
        $mentors = User::get()->map(fn($item)=>['value'=>$item->id,'text'=>$item->name,'label'=>optional($item->staff)->name_kh])->toArray();
        $students = Profile::get()->map(fn($item)=>['value'=>$item->id,'text'=>$item->name_en,'label'=>$item->identity])->toArray();
        return ['courses'=>$courses,'mentors'=>$mentors,'students'=>$students];
    }

    public function saveItems($info,$list)
    {
        try{
            $info = Info::create([
                'user_id'=>auth()->user()->id,
                'off'=>Arr::get($info,'off'),
                'course_id'=>Arr::get($info,'course'),
                'staff_id'=>Arr::get($info,'mentor'),
                'student_id'=>Arr::get($info,'student'),
                'phonenumber'=>Arr::get($info,'phonenumber')
            ]);

            foreach($list as $item):
                Detail::create([
                    'desc'=>Arr::get($item,'desc'),
                    'amount'=>Arr::get($item,'amount'),
                    'tuition_info_id'=>$info->id
                ]);
            endforeach;
        }
        catch(Error $err){ dd($err->getMessage()); }
    }
}
