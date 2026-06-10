<?php

namespace App\Http\Livewire\Management;

use App\Library\GetValueTextList;
use Livewire\Component;

class TuitionFee extends Component
{
    public function render()
    {
        return view('livewire.management.tuition-fee');
    }

    public function references()
    {
        $courses = (new GetValueTextList)->convert(\App\Models\Course\Header::get());
        return compact('courses');
    }

    public function load($page,$per_page,$filter)
    {
        $model = \App\Models\Student\Profile::class;
        return $model::with('tuitionFee.course.detail.staff')->paginate($per_page,['*'],'page',$page)->toArray();
    }

    public function updateRecord($data)
    {
        dd($data);
    }
}
