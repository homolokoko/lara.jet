<?php

namespace App\Http\Livewire\Management\Staff;

use Livewire\Component;
use App\Models\Staff\User;
use Illuminate\Support\Str;
use App\Library\GetValueTextList;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Storage;

class Edit extends Component
{
    public function render()
    {
        return view('livewire.management.staff.edit');
    }

    public function show($id)
    {
        $user = \App\Models\Staff\User::find($id);
        return [
            'id'=>$user->id,
            'email'=>$user->email,
            'name_en'=>$user->name,
            'name_kh'=>$user->staff->name_kh,
            'is_female'=>$user->staff->is_female,
            'is_married'=>$user->staff->is_married,
            'dob'=>$user->staff->dob,
            'lvl'=>$user->staff->level,
            'edu_lvl'=>$user->staff->edu_lvl,
            'position'=>$user->staff->position_id,
            'img'=>$user->photograph,
            'tel_main'=> $user->phoneNumbers->where('is_important',true)->first()->phone_number,
            'tel_opt'=> $user->phoneNumbers->where('is_important',false)->first()->phone_number,
            'parent_info'=>$user->parentCareer,
            'birth_add'=>$user->addresses->where('is_current',false)->map(fn($i)=>[
                'id'=>$i->id,
                'street'=>$i->street->name,
                'city'=>$i->city->name,
                'state'=>$i->state->name,
                'zip'=>$i->zip_id
            ])->first(),
            'current_add'=>$user->addresses->where('is_current',true)->map(fn($i)=>[
                'id'=>$i->id,
                'street'=>$i->street->name,
                'city'=>$i->city->name,
                'state'=>$i->state->name,
                'zip'=>$i->zip_id
            ])->first(),
        ];
    }

    public function getRelatedList()
    {
        $positions = GetValueTextList::convert(
            \App\Models\Staff\Position::get()
        );
        $zips = GetValueTextList::convert(
            \Modules\CountryCatalog\Entities\Zip::where('country_id', 30)->get()
        );

        return compact('zips','positions');
    }

    public function upgrade($data)
    {
        $userid = $data['id'];

        $newStaff['position_id'] = $data['position'];
        $newStaff['name_kh'] = $data['name_kh'];
        $newStaff['name_en'] = $data['name_en'];
        $newStaff['edu_lvl'] = $data['edu_lvl'];
        $newStaff['is_female'] = $data['is_female'];
        $newStaff['is_married'] = $data['is_married'];
        $newStaff['level'] = $data['lvl'];
        $newStaff['dob'] = $data['dob'];

        \App\Models\Staff::where('user_id',$userid)->update($newStaff);

        $newStaffPhotograph['file_path'] = $data['img']['file_path'];

        \App\Models\Staff\Photograph::where('user_id',$userid)->update($newStaffPhotograph);

        $newStaffPhoneNumber['phone_number'] = $data['tel_main'];

        \App\Models\Staff\PhoneNumber::where(['user_id'=>$userid,'is_important'=>true])->update($newStaffPhoneNumber);

        $newParentCareer['dad_name'] = $data['parent_info']['dad_name'];
        $newParentCareer['dad_career'] = $data['parent_info']['dad_career'];
        $newParentCareer['mom_name'] = $data['parent_info']['mom_name'];
        $newParentCareer['mom_career'] = $data['parent_info']['mom_career'];

        \App\Models\Staff\ParentCareer::where('user_id',$userid)->update($newParentCareer);

        if ($data['birth_add']) {
            $zip_id = $data['birth_add']['zip'];
            $state_name = Str::of($data['birth_add']['state'])->snake()->lower();
            $city_name = Str::of($data['birth_add']['city'])->snake()->lower();
            $street_name = Str::of($data['birth_add']['street'])->snake()->lower();
            $newState = \Modules\CountryCatalog\Entities\State::updateOrCreate(
                ['name' => $state_name],
                ['zip_id' => $zip_id, 'name' => $state_name]
            );
            $newCity = \Modules\CountryCatalog\Entities\City::updateOrCreate(
                ['name' => $city_name],
                ['state_id' => $newState->id, 'name' => $city_name]
            );
            $newStreet = \Modules\CountryCatalog\Entities\Street::updateOrCreate(
                ['name' => $street_name],
                ['city_id' => $newCity->id, 'name' => $street_name]
            );
            \App\Models\Staff\Address::where([
                'user_id'=>$userid,
                'is_current'=>false,
            ])
            ->update([
                'street_id' => $newStreet->id,
                'city_id' => $newCity->id,
                'state_id' => $newState->id,
                'zip_id' => $zip_id,
            ]);
        }
        if ($data['current_add']) {
            $zip_id = $data['current_add']['zip'];
            $state_name = Str::of($data['current_add']['state'])->snake()->lower();
            $city_name = Str::of($data['current_add']['city'])->snake()->lower();
            $street_name = Str::of($data['current_add']['street'])->snake()->lower();
            $newState = \Modules\CountryCatalog\Entities\State::updateOrCreate(
                ['name' => $state_name],
                ['zip_id' => $zip_id, 'name' => $state_name]
            );
            $newCity = \Modules\CountryCatalog\Entities\City::updateOrCreate(
                ['name' => $city_name],
                ['state_id' => $newState->id, 'name' => $city_name]
            );
            $newStreet = \Modules\CountryCatalog\Entities\Street::updateOrCreate(
                ['name' => $street_name],
                ['city_id' => $newCity->id, 'name' => $street_name]
            );
            \App\Models\Staff\Address::where([
                'user_id'=>$userid,
                'is_current'=>true,
            ])
            ->update([
                'street_id' => $newStreet->id,
                'city_id' => $newCity->id,
                'state_id' => $newState->id,
                'zip_id' => $zip_id,
            ]);
        }

        if ($data['tel_opt']) {
            $newStaffPhoneNumberOpt['phone_number'] = $data['tel_opt'];
            \App\Models\Staff\PhoneNumber::where(['user_id'=>$userid,'is_important'=>false])->update($newStaffPhoneNumberOpt);
        }

        $file_temp = $data['img']['file_path'];

        if(!Storage::disk('public')->exists('staff/photograph/' . $file_temp))
            Storage::disk('public')->copy('tmp/'.$file_temp,'staff/photograph/' . $file_temp);
    }
}
