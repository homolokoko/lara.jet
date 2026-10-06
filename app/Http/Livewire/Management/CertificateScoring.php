<?php

namespace App\Http\Livewire\Management;

use App\Library\Helper;
use App\Models\Staff;
use App\Models\Student\Profile;
use Illuminate\Support\Arr;
use Livewire\Component;

class CertificateScoring extends Component
{
    public function render()
    {
        return view('livewire.management.certificate-scoring');
    }

    public function getSourceData()
    {
        $types = Helper::getType();
        $years = Helper::getYear();
        $levels = Helper::getLevel();
        $months = Helper::getMonth();
        $shifts = Helper::getShift();
        $study_periods = Helper::getStudyPeriod();
        $staffs = Staff::get()->map(fn($i)=>['value'=>$i->user_id,'text'=>join(' ',[$i->name_en,$i->name_kh])]);
        $students = Profile::get()->map(fn($i)=>['value'=>$i->id,'text'=>join(' ',[$i->identity,$i->name_en,$i->name_kh])]);
        return compact('types','years','levels','months','shifts','study_periods','staffs','students');
    }

    public function submitItem($filter,$data)
    {
        dd(compact('filter','data'));

    }

    public function getRelatedStudent($filter)
    {
        dd(
            array(
                empty($filter['shift']),
                empty($filter['month']),
                empty($filter['year'])
            )
        );
        $query = Profile::with('staff')->where('staff_id',auth()->user()->id);
        if(!empty($filter)){
            if(!empty(Arr::get($filter,'shift'))){
                $query->where('shift',Arr::get($filter,'shift'));
            }
        }
        if(empty(Arr::get($filter,'month'))){
            return [];
        }else{
            return $query->get()->map(fn($item)=>[
                'id'=>$item->id,
                'identity'=>$item->identity,
                'name_en'=>$item->name_en,
                'name_kh'=>$item->name_kh,
                'is_female'=>$item->is_female,
                'is_absent'=>0,
                'shift_period'=>$item->shift_period,
                'status'=>0,
                'staff'=>[
                    'id'=>$item->staff->id,
                    'name'=>join(' ',[$item->staff->email,$item->staff->name])
                ]
            ])->toArray();
        }
    }
}
