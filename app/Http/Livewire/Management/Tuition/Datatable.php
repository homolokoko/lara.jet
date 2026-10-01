<?php

namespace App\Http\Livewire\Management\Tuition;

use App\Models\Tuition\Info;
use Livewire\Component;

class Datatable extends Component
{
    public function render()
    {
        return view('livewire.management.tuition.datatable');
    }

    public function retrievedata($page,$perpage,$filter)
    {
        return Info::with('user','staff','student','course')->paginate($perpage,'*',$page)->toArray();
    }
}
