<?php

namespace App\Http\Livewire\Management\Staff;

use App\Library\GetValueTextList;
use Illuminate\Support\Facades\Storage;
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

    public function getAllPositions()
    {
        return GetValueTextList::convert(
            \App\Models\Staff\Position::get()
        );
    }

    public function save($data)
    {

        $file_temp = $data['img']['file_path'];
        // Storage::disk('public')->copy('tmp/'.$file_temp,'staff/photograph/'.$file_temp);

    }
}
