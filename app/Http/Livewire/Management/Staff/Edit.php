<?php

namespace App\Http\Livewire\Management\Staff;

use App\Library\GetValueTextList;
use App\Library\Helper;
use App\Models\Member\Role;
use App\Models\User;
use App\Models\Member\{Address,Relative,Phonenumber,Detail,RelativePhonenumber};
use Illuminate\Support\Arr;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;
use Livewire\Component;
use Modules\CountryCatalog\Entities\{Street,City,State};

class Edit extends Component
{
    public function render()
    {
        return view('livewire.management.staff.edit');
    }

    public function show($id)
    {
        $data = User::with(
            'roles',
            'phonenumbers',
            'addresses.street',
            'addresses.city',
            'addresses.state',
            'addresses.zip',
            'photograph',
            'relatives.phonenumbers'
        )->find($id)->toArray();

        return $data;
    }

    public function getRelatedList()
    {
        $zips = GetValueTextList::convert(
            \Modules\CountryCatalog\Entities\Zip::where('country_id', 30)->get()
        );
        $roles = GetValueTextList::convert(\App\Models\Member\Role::get());
        $levels = Helper::getLevel();
        $edu_levels = Helper::getEducationLevel();

        return compact('zips','roles','levels','edu_levels');
    }

    public function upgrade($data)
    {
        $user = User::with(
            'roles',
            'detail',
            'relatives',
            'addresses.street',
            'addresses.city',
            'addresses.state',
            'addresses.zip',
            'phonenumbers'
        )->find($data['id']);

        dd(['user'=>$user->toArray(),'data'=>$data]);
        $user->update([
            'name'=>$data['name'],
            'locale'=>$data['locale'],
        ]);

        foreach((Arr::get('addresses') as $address):
            $zip_id = Arr::get($address,'zip_id') ? Arr::get($address,'zip_id') : Arr::get($address,'zip.id');
            $state_name = Str::of(Arr::get($address,'state.name'))->snake()->lower();
            $city_name = Str::of(Arr::get($address,'city.name'))->snake()->lower();
            $street_name = Str::of(Arr::get($address,'street.name'))->snake()->lower();
            $newState = State::updateOrCreate(
                ['name' => $state_name],
                ['zip_id' => $zip_id, 'name' => $state_name]
            );
            $newCity = City::updateOrCreate(
                ['name' => $city_name],
                ['state_id' => $newState->id, 'name' => $city_name]
            );
            $newStreet = Street::updateOrCreate(
                ['name' => $street_name],
                ['city_id' => $newCity->id, 'name' => $street_name]
            );
            $addressUpdate = Address::updateOrCreate(
                ['user_id'=>$user->id,'is_current'=>Arr::get($address,'is_current')],
                ['street_id'=>$newStreet->id]
            );
        endforeach;

        foreach(Arr::get($data,'relatives') as $relative):
            $relativeUpdate = Relative::updateOrCreate(
                ['who_they'=>Arr::get($relative,'who_they'),'user_id'=>$user->id],
                ['name'=>Arr::get($relative,'name'),'career'=>Arr::get($relative,'career'),'is_current'=>Arr::get($relative,'is_current')]
            );
            foreach(Arr::get($relative,'phonenumbers') as $phone):
                $relativePhonenumberUpdate = RelativePhonenumber::updateOrCreate(
                    ['user_relative_id'=>$relativeUpdate->id,'id'=>Arr::get($phone,'id')],
                    ['number'=>Arr::get($phone,'number')]
                );
            endforeach;
        endforeach;

        return;

        $userid = $data['id'];

        $newStaff['position_id'] = $data['position'];
        $newStaff['name_kh'] = $data['name_kh'];
        $newStaff['name_en'] = $data['name_en'];
        $newStaff['edu_lvl'] = $data['edu_lvl'];
        $newStaff['is_female'] = $data['is_female'];
        $newStaff['is_married'] = $data['is_married'];
        $newStaff['level'] = $data['lvl'];
        $newStaff['dob'] = $data['dob'];

        \App\Models\Staff\User::where('id',$userid)->update(['name'=>$data['name_en'],'email'=>$data['email']]);

        \App\Models\Staff::where('user_id',$userid)->update($newStaff);

        $newStaffPhotograph['file_path'] = $data['img']['file_path'] ?? '';

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

        $file_temp = $data['img']['file_path'] ?? '';

        if(!Storage::disk('public')->exists('staff/photograph/' . $file_temp))
            Storage::disk('public')->copy('tmp/'.$file_temp,'staff/photograph/' . $file_temp);
    }
}
