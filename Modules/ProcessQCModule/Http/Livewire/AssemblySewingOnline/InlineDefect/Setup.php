<?php

namespace Modules\ProcessQCModule\Http\Livewire\AssemblySewingOnline\InlineDefect;

use App\Models\Buyer;
use Livewire\Component;

use Illuminate\Support\Arr;

use Illuminate\Support\Str;
use App\Library\GetValueTextList;
use Modules\ProcessQCModule\Entities\PQI;

class Setup extends Component
{

    public array $buyers, $defects;


    public function boot()
    {
        $this->listDefect();
        $this->buyers = GetValueTextList::convert(Buyer::get());
    }

    public function listDefect()
    {
        $this->defects = PQI\Defect::where('parent_id',null)
            ->get()->map(fn($item)=>['value'=>$item->id,'text'=>$item->name])->toArray();
    }

    public function render()
    {
        return view('processqcmodule::livewire.assembly-sewing-online.inline-defect.setup');
    }

    public function submit($data)
    {
        foreach(Arr::get($data,'list') as $item){
            $defect = PQI\Defect::create(['parent_id'=>Arr::get($data,'defect.value')]);
            $translations = $this->addNewDefect(Arr::get($item,'locale'),$defect->id);
            $serverities = $this->addNewServerity(Arr::get($item,'serverity'),$defect->id);
        }
    }

    public function newGropName($data)
    {
        Arr::set($defect,'buyer_id',Arr::get($data,'buyer.value'));
        $defect = PQI\Defect::create($defect);
        $this->addNewDefect(Arr::get($data,'locale'),$defect->id);
        $this->listDefect();

    }

    public function addNewDefect($locale,$defect_id){
        foreach($locale as $key=>$val){
            Arr::set($translation,'locale',$key);
            Arr::set($translation,'translated', Str::snake(strtolower($val)));
            Arr::set($translation,'pqi_defect_id',$defect_id);
            PQI\DefectTranslation::create($translation);
        }
    }

    public function addNewServerity($serverity,$defect_id)
    {
        foreach($serverity as $state)
        {
            PQI\DefectServerity::create(['pqi_defect_id'=>$defect_id,'type'=>$state,'value'=>true]);
        }
    }
}
