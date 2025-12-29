<?php

namespace App\Http\Livewire\Management\Staff;

use Illuminate\Support\Facades\Hash;
use App\Library\GetValueTextList;
use App\Models\User;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;
use Livewire\Component;

class Create extends Component
{
    public function render()
    {
        return view('livewire.management.staff.create');
    }

    public function getAllZips()
    {
        return GetValueTextList::convert(
            \Modules\CountryCatalog\Entities\Zip::where('country_id', 30)->get()
        );
    }

    public function getAllPositions()
    {
        return GetValueTextList::convert(
            \App\Models\Staff\Position::get()
        );
    }

    public function save($data)
    {

        $newParentCareer['user_id'] = 1;
        $newParentCareer['dad_name'] = $data['parent_info']['dad_name'];
        $newParentCareer['dad_career'] = $data['parent_info']['dad_career'];
        $newParentCareer['mom_name'] = $data['parent_info']['mom_name'];
        $newParentCareer['mom_career'] = $data['parent_info']['mom_career'];
        \App\Models\Staff\ParentCareer::create($newParentCareer);
        return;
        $zip_id = $data['birth_add']['zip'];
        $newUser = User::updateOrCreate(
            [
                'name' => $data['name_en'],
                'email' => $data['email']
            ],
            [
                'password' => Hash::make(123),
                'name' => $data['name_en'],
                'email' => $data['email']
            ]
        );

        $newStaff['user_id'] = $newUser->id;
        $newStaff['position_id'] = $data['position'];
        $newStaff['name_kh'] = $data['name_kh'];
        $newStaff['name_en'] = $data['name_en'];
        $newStaff['edu_lvl'] = $data['edu_lvl'];
        $newStaff['is_female'] = $data['is_female'];
        $newStaff['is_married'] = $data['is_married'];
        $newStaff['level'] = $data['lvl'];
        $newStaff['dob'] = $data['dob'];

        \App\Models\Staff::create($newStaff);

        $newStaffPhotograph['user_id'] = $newUser->id;
        $newStaffPhotograph['file_path'] = $data['img']['file_path'];

        \App\Models\Staff\Photograph::create($newStaffPhotograph);

        $newStaffPhoneNumber['user_id'] = $newUser->id;
        $newStaffPhoneNumber['phone_number'] = $data['tel_main'];

        \App\Models\Staff\PhoneNumber::create($newStaffPhoneNumber);

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
            \App\Models\Staff\Address::create([
                'user_id' => $newUser->id,
                'street_id' => $newStreet->id,
                'city_id' => $newCity->id,
                'state_id' => $newState->id,
                'zip_id' => $zip_id,
                'is_current' => false
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
            \App\Models\Staff\Address::create([
                'user_id' => $newUser->id,
                'street_id' => $newStreet->id,
                'city_id' => $newCity->id,
                'state_id' => $newState->id,
                'zip_id' => $zip_id,
                'is_current' => true
            ]);
        }

        if ($data['tel_opt']) {
            $newStaffPhoneNumberOpt['user_id'] = $newUser->id;
            $newStaffPhoneNumberOpt['phone_number'] = $data['tel_opt'];
            \App\Models\Staff\PhoneNumber::create($newStaffPhoneNumberOpt);
        }

        $file_temp = $data['img']['file_path'];

        if ($file_temp)
            $is_file_exist = Storage::disk('public')->exists('staff/photograph/' . $file_temp);
    }
}
