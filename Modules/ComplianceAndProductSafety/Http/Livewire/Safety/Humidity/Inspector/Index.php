<?php

namespace Modules\ComplianceAndProductSafety\Http\Livewire\Safety\Humidity\Inspector;

use Livewire\Component;
use App\Models\Style;
use App\Models\Location;
use Illuminate\Support\Arr;
use App\Library\GetValueTextList;
use Modules\ComplianceAndProductSafety\Entities\Humidity;

class Index extends Component
{
    public array $time_periods, $styles, $locations;

    public function mount()
    {
        $this->styles = GetValueTextList::convert(Style::get());

        $this->locations = GetValueTextList::convert(Location::get());

        $this->time_periods = GetValueTextList::convert(Humidity\TimePeriodEntity::get());
    }

    public function render()
    {
        return view('complianceandproductsafety::livewire.safety.humidity.inspector.index');
    }

    public function submit($filter)
    {
        $data = array(
            'style_id'=>Arr::get($filter,'style.value'),
            'humidity'=>Arr::get($filter,'humidity'),
            'location_id'=>Arr::get($filter,'location.value'),
            'temperature'=>Arr::get($filter,'temperature'),
            'time_period_id'=>Arr::get($filter,'time.value'),
        );

        return Humidity\RootEntity::create($data);
    }

}
