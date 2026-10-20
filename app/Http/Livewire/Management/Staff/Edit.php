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
use Modules\CountryCatalog\Entities\{Zip,Street,City,State};

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
            'detail',
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
        $zips = GetValueTextList::convert(Zip::where('country_id', 30)->get());
        $roles = GetValueTextList::convert(\App\Models\Member\Role::get());
        $levels = Helper::getLevel();
        $edu_levels = Helper::getEducationLevel();

        return compact('zips','roles','levels','edu_levels');
    }

    public function upgrade($data)
    {
        $user = User::find($data['id']);

        $user->update([
            'name'=>Arr::get($data,'name'),
            'locale'=>Arr::get($data,'locale'),
            'profile_photo_path'=>Arr::get($data,'photo.file_path',null)
        ]);

        $user->syncRoles(Arr::get($data,'roleList'));

        if(Storage::disk('tmp')->exists(Arr::get($data,'photo.file_path'))){
            Storage::disk('public')->put(Arr::get($data,'photo.file_path'),Storage::disk('tmp')->get(Arr::get($data,'photo.file_path')));
        }

        foreach(Arr::get($data,'addresses') as $address):
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

        Detail::updateOrCreate(['user_id'=>$user->id],Arr::get($data,'detail',null));

        return;
    }
}
