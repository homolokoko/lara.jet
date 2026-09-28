<?php

namespace Modules\ProcessQCModule\Http\Livewire\AssemblySewingOnline\InlineDefect;

use App\Models\Buyer;
use Illuminate\Database\Eloquent\Collection;
use Livewire\Component;

use Illuminate\Support\Arr;

use Illuminate\Support\Str;
use App\Library\GetValueTextList;
use Modules\ProcessQCModule\Entities\PQI;

class Setup extends Component
{

    public array $buyer = [], $defect = [];
    public array $buyers = [], $defects = [], $extra_defects = [];


    public function boot()
    {
//        $this->listDefect();
        $this->buyers = GetValueTextList::convert(Buyer::get());
    }

    public function updatedBuyer(){ $this->listDefect(); }

    public function listDefect()
    {
        $this->defects = GetValueTextList::convert(
            PQI\Defect::where(['parent_id'=>null,'buyer_id'=>Arr::get($this->buyer,'value')])->get()
        );
    }

    public function updatedDefect()
    {
        $this->extra_defects = GetValueTextList::convert(
            PQI\Defect::where(['parent_id'=>Arr::get($this->defect,'value')])->get()
        );
    }

    public function listDefectOnSpecificItems()
    {
        $this->defects = GetValueTextList::convert(
            PQI\Defect::where(['parent_id'=>null,'pqi_defect_type_id'=>2])->get()
        );
    }

    public function render()
    {
        return view('processqcmodule::livewire.assembly-sewing-online.inline-defect.setup');
    }

    public function submit($data)
    {
//        dd(Arr::get($data,'defect.value'));
        if(Arr::get($data,'extra_defect.value'))
            $root = PQI\Defect::where('id',Arr::get($data,'extra_defect.value'))->first();
        else
            $root = PQI\Defect::where('id',Arr::get($data,'defect.value'))->first();
        foreach(Arr::get($data,'list') as $item){
            $defect = $root->children()->create(['is_defect'=>true]);
            $translations = $this->addNewDefect(Arr::get($item,'locale'),$defect->id);
            $serverities = $this->addNewServerity(Arr::get($item,'serverity'),$defect->id);
        }
    }

    public function newGropName($data)
    {
        Arr::set($defect,'buyer_id',Arr::get($data,'buyer.value'));
        Arr::set($defect,'pqi_defect_type_id',2);
        $defect = PQI\Defect::create($defect);
        $this->addNewDefect(Arr::get($data,'locale'),$defect->id);
        $this->listDefect();
//        $this->listDefectOnSpecificItems();
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
