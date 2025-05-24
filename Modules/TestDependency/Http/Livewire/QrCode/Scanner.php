<?php

namespace Modules\TestDependency\Http\Livewire\QrCode;

use Livewire\Component;

class Scanner extends Component
{
    public function render()
    {
        return view('testdependency::livewire.qr-code.scanner');
    }
}
