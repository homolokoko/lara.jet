<?php

namespace Modules\SchoolManagement\Http\Livewire\Student;

use Livewire\Component;

class Index extends Component
{
    public $tab=1;
    public $studentId;

    public function render()
    {
        return view('schoolmanagement::livewire.student.index');
    }

    public function navigatePage($tab)
    {
        $this->tab = $tab;
    }
}
