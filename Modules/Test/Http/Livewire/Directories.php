<?php

namespace Modules\Test\Http\Livewire;

use Livewire\Component;

class Directories extends Component
{
    public $name;

    public function render()
    {
        return view('test::livewire.directories');
    }
}
