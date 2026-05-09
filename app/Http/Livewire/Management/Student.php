<?php

namespace App\Http\Livewire\Management;

use App\Library\GetValueTextList;
use Livewire\Component;
use Modules\CountryCatalog\Entities\Zip;

class Student extends Component
{
    public function render()
    {
        return view('livewire.management.student');
    }

    public function load()
    {
        $zips = (new GetValueTextList)->convert(Zip::get());
        return compact('zips');
    }
}
