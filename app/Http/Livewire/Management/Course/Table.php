<?php

namespace App\Http\Livewire\Management\Course;

use Livewire\Component;

class Table extends Component
{
    public function render()
    {
        return view('livewire.management.course.table');
    }

    public function datatable($page,$per_page,$filter)
    {
        return [];
    }
}
