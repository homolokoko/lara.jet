<?php

namespace Modules\CountryCatalog\Http\Livewire;

use Livewire\Component;
use Modules\CountryCatalog\Entities;

class Index extends Component
{
    public function render()
    {
        return view('countrycatalog::livewire.index');
    }

    public function retrieve($page,$per_page,$filter)
    {
        $query = Entities\Country::with('zips.states.cities.streets.people');
        return $query->paginate($per_page,['*'],'page',$page)->toArray();
    }

    public function remove($type,$id)
    {
        switch($type) {
            case 'country':
                $item = Entities\Country::class;
                break;
            case 'zip':
                $item = Entities\Zip::class;
                break;
            case 'state':
                $item = Entities\State::class;
                break;
            case 'city':
                $item = Entities\City::class;
                break;
            case 'street':
                $item = Entities\Street::class;
                break;
            case 'person':
                $item = Entities\Person::class;
                break;
        };
        $item::where('id',$id)->delete();
    }

    public function add($type,$id,$name)
    {
        switch($type) {
            case 'country':
                $data = ['country_id' => $id,'name' => $name];
                $item = Entities\Zip::class;
                break;
            case 'zip':
                $data = ['zip_id' => $id,'name' => $name];
                $item = Entities\State::class;
                break;
            case 'state':
                $data = ['state_id' => $id,'name' => $name];
                $item = Entities\City::class;
                break;
            case 'city':
                $data = ['city_id' => $id,'name' => $name];
                $item = Entities\Street::class;
                break;
            case 'street':
                $data = ['street_id' => $id,'name' => $name];
                $item = Entities\Person::class;
                break;
            default:
                $data = ['name'=>$name];
                $item = Entities\Country::class;
                break;
        };
        $item::create($data);
    }

    public function modify($type,$id,$name)
    {
        switch($type) {
            case 'country':
                $item = Entities\Country::class;
                break;
            case 'zip':
                $item = Entities\Zip::class;
                break;
            case 'state':
                $item = Entities\State::class;
                break;
            case 'city':
                $item = Entities\City::class;
                break;
            case 'street':
                $item = Entities\Street::class;
                break;
            case 'person':
                $item = Entities\Person::class;
                break;
        };
        $item::where('id',$id)->update(['name'=>$name]);
    }
}
