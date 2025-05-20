<?php

namespace Modules\ComplianceAndProductSafety\Http\Livewire\Safety\Humidity\Setup;

use Livewire\Component;
use App\Models\Style;
use App\Library\GetValueTextList;

class Index extends Component
{
    public array $styles, $fabric_contents;

    public function mount()
    {
        $this->fabric_contents = [];

        $this->styles = GetValueTextList::convert(Style::get());
    }

    public function render()
    {
        return view('complianceandproductsafety::livewire.safety.humidity.setup.index');
    }
}
