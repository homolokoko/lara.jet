<?php

namespace App\Http\Livewire\Management\Staff;

use App\Library\GetValueTextList;
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
            \Modules\CountryCatalog\Entities\Zip::where('country_id',30)->get()
        );
    }

    public function save($data)
    {
        dd($data);

    }
}
