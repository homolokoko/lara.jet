<?php

namespace App\Http\Livewire\Management;

use App\Library\GetValueTextList;
use Livewire\Component;
use App\Models\Staff;
use App\Models\Student\{Profile,Relative};
use Illuminate\Support\Arr;
use Illuminate\Support\Str;
use Modules\CountryCatalog\Entities;

use function PHPUnit\Framework\isEmpty;

class Student extends Component
{
    public function render()
    {
        return view('livewire.management.student');
    }

    public function load()
    {
        $zips = (new GetValueTextList)->convert(Entities\Zip::get());
        $staffs = Staff::select('user_id as value','name_en as text')->get()->toArray();
        return compact('zips','staffs');
    }

    public function create($data)
    {
        if(!isEmpty(Arr::get($data,'birth.state')))
        {
            $birth_state_name = Str::of(Arr::get($data,'birth.state'))->lower()->snake();
            $birth_state = Entities\State::firstOrCreate(['name'=>$birth_state_name],['name'=>$birth_state_name,'zip_id'=>Arr::get($data,'birth.zip')]);
        }
        if(!isEmpty(Arr::get($data,'birth.city')))
        {
            $birth_city_name = Str::of(Arr::get($data,'birth.city'))->lower()->snake();
            $birth_city = Entities\City::firstOrCreate(['name'=>$birth_city_name],['name'=>$birth_city_name,'zip_id'=>$birth_state->id]);
        }

        if(!isEmpty(Arr::get($data,'birth.street')))
        {
            $birth_street_name = Str::of(Arr::get($data,'birth.street'))->lower()->snake();
            $birth_street = Entities\City::firstOrCreate(['name'=>$birth_street_name],['name'=>$birth_street_name,'zip_id'=>$birth_city->id]);
        }
        if(!isEmpty(Arr::get($data,'cur.state')))
        {
            $current_state_name = Str::of(Arr::get($data,'cur.state'))->lower()->snake();
            $current_state = Entities\State::firstOrCreate(['name'=>$current_state_name],['name'=>$current_state_name,'zip_id'=>Arr::get($data,'cur.zip')]);
        }
        if(!isEmpty(Arr::get($data,'cur.city')))
        {
            $current_city_name = Str::of(Arr::get($data,'cur.city'))->lower()->snake();
            $current_city = Entities\City::firstOrCreate(['name'=>$current_city_name],['name'=>$current_city_name,'zip_id'=>$current_state->id]);
        }

        if(!isEmpty(Arr::get($data,'cur.street')))
        {
            $current_street_name = Str::of(Arr::get($data,'cur.street'))->lower()->snake();
            $current_street = Entities\City::firstOrCreate(['name'=>$current_street_name],['name'=>$current_street_name,'zip_id'=>$current_city->id]);
        }
        if(!isEmpty($data,'father.name'))
        {
            $father = Relative::create([
                'name'=>Arr::get($data,'father.name'),
                'job'=>Arr::get($data,'father.job'),
                'main_number'=>Arr::get($data,'father.main_number'),
                'subs_number'=>Arr::get($data,'father.subs_number'),
            ]);
        }

        if(!isEmpty($data,'mother.name'))
        {
            $mother = Relative::create([
                'name'=>Arr::get($data,'mother.name'),
                'job'=>Arr::get($data,'mother.job'),
                'main_number'=>Arr::get($data,'mother.main_number'),
                'subs_number'=>Arr::get($data,'mother.subs_number'),
            ]);
        }

        if(!isEmpty($data,'name_en') && !isEmpty($data,'gender') && !isEmpty(Arr::get($data,'dob')))
        {
            Profile::creat([
                'name_kh'=>Arr::get($data,'name_kh'),
                'name_en'=>Arr::get($data,'name_en'),
                'gender'=>Arr::get($data,'gender'),
                'date_of_birth'=>Arr::get($data,'dob'),
                'other'=>Arr::get($data,'other',null),
                'room'=>Arr::get($data,'class_room',null),
                'staff_id'=>Arr::get($data,'staff',null),
                'shift'=>Arr::get($data,'shift',null),
                'father_id'=>$father ? $father->id:null,
                'mother_id'=>$mother ? $mother->id:null,
                'birth_address_id'=> $birth_street ? $birth_street->id:null,
                'current_address_id'=> $current_street ? $current_street->id:null,
                ''
            ]);
            return ['status'=>true,'message'=>'Created student successfull!'];
        }else{
            if(isEmpty($data,'name_en'))
                return ['status'=>false,'message'=>'Need to assign name for student.'];
            if(isEmpty($data,'gender'))
                return ['status'=>false,'message'=>'Need to assign gender for student.'];
            if(isEmpty($data,'dob'))
                return ['status'=>false,'message'=>'Need to assign date of birth for student.'];
        }



    }
}
