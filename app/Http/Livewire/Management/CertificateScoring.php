<?php

namespace App\Http\Livewire\Management;

use App\Library\Helper;
use App\Models\CertificateGrading\Detail;
use App\Models\CertificateGrading\Header;
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
        $headerData = [
            'year'=>Arr::get($filter,'year'),
            'month'=>Arr::get($filter,'month'),
            'shift'=>Arr::get($filter,'shift'),
            'final_at'=>Arr::get($filter,'final_at'),
            'lvl'=>Arr::get($filter,'lvl')
        ];
        $header = Header::create($headerData);
        foreach($data as $item):
            Detail::create(['header_id'=>$header->id,'is_absent'=>Arr::get($item,'is_absent'),'student_id'=>Arr::get($item,'id')]);
        endforeach;
    }

    public function getRelatedStudent($filter)
    {
        $query = Profile::with('staff')->where('staff_id',auth()->user()->id);
        $header = Header::where($filter)->first();
        if(!empty($filter)){
            if(!empty(Arr::get($filter,'shift'))){
                $query->where('shift',Arr::get($filter,'shift'));
            }
        }
        $validates = array(
                empty($filter['shift']),
                empty($filter['month']),
                empty($filter['year'])
            );
        if(in_array(true,$validates)){
            return [];
        }else{
            debug('header_id',$header->id ?? null);
            return $query->get()->map(function($item) use ( $header){
                $find = Detail::where(['header_id'=>optional($header)->id,'student_id'=>$item->id])->first();
                return [
                    'id'=>$item->id,
                    'identity'=>$item->identity,
                    'name_en'=>$item->name_en,
                    'name_kh'=>$item->name_kh,
                    'is_female'=>$item->is_female,
                    'is_absent'=> $find ? $find->is_absent:0,
                    'shift_period'=>$item->shift_period,
                    'is_empty'=>empty($find),
                    'staff'=>[
                        'id'=>$item->staff->id,
                        'name'=>join(' ',[$item->staff->email,$item->staff->name])
                    ]
                ];
            })->toArray();

        }
    }

    public function updateDetail($student_id,$is_absent){
        Detail::where('student_id',$student_id)->update(['is_absent'=>$is_absent]);
    }
}
