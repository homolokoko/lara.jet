<?php

namespace App\Http\Livewire\Management;

use Livewire\Component;

class Course extends Component
{
    public function render()
    {
        return view('livewire.management.course');
    }

    public function datatable($page,$per_page,$filter)
    {

    }
}
