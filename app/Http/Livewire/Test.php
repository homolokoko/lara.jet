<?php

namespace App\Http\Livewire;

use App\Http\Controllers\Library\Ezi\StyleSubmission;
use App\Models\Configure\Buyers;
use Exception;
use Livewire\Component;

use App\Http\Controllers\ListController;
use App\Models\Auditor\Inspection;
use Illuminate\Support\Arr;
use Log;
use Vinkla\Hashids\Facades\Hashids;

class Test extends Component
{
    public $data;
    public $sectionName = '';

    public function mount()
    {
        $data = Inspection\Header::with([
            'styleInformation.style',
            'styleInformation.purchaseOrder'
        ])->get()->find(16)->toArray();
//        $buyer = Arr::get($data, 'buyer_id', '');
        $this->data = Arr::get($data, 'style_information', []);
        $buyer = Arr::get($data, 'buyer_id', '');
        $this->data = Arr::get($data, 'style_information', []);
        if($buyer) {
            $this->getStyle($buyer);

            if(Arr::exists($data, 'style_information')){
                $styleInformation = Arr::get($data, 'style_information');
                //$this->emit('update-garment-references',collect($styleInformation)->pluck('style_id')->unique());
                $style = collect($styleInformation)->pluck('style_id')->unique()->toArray();
                $this->dispatchBrowserEvent('update-garment-references-style',$style);

            }
            $this->sectionStatus(count( $this->data ) > 0);
        } else {
            $this->sectionStatus(false);
            $this->emit('alert_error', ['message'=>"This Buyer does not have any style"]);
        }
        $this->dispatchBrowserEvent('update-style-section-a-list');
    }

    public function render()
    {
        return view('livewire.test');
    }

    public function sectionStatus(bool $isCompleted){
        $this->emit('update-progress-status',['section'=>$this->sectionName, 'isCompleted'=>$isCompleted]);
    }

    public function addedStyleOrderNo($style)
    {
        try {
            $styleSubmission = new StyleSubmission();
            $buyer = Buyers::find(10)->name;
            $buyerArr = ['text' => $buyer, 'value' => $buyer];
            $styleDB = $styleSubmission->save($buyerArr, $style);
            $this->style = $styleDB->id;
            $this->getPurchaseOrder($styleDB->id);
        } catch (Exception $e) {
            Log::error($e->getMessage());
            $this->emit('toast_error', ['message' => 'Update failed: '.$e->getMessage()]);
        }
    }

    public function getPurchaseOrder($style)
    {
        $listed = new ListController();
        $styleList = $listed->getPurchaseOrder($style);
        debug('style list',$styleList);
        $this->dispatchBrowserEvent('update-purchase-order-section-a-list', $styleList);


    }

    public function getStyle($buyer)
    {
        $listed = new ListController();
        $styleList = $listed->getStyle($buyer);
        debug($styleList->toArray());
        $this->dispatchBrowserEvent('update-style-section-a-list', $styleList);
    }

    public function submit($data)
    {
        dd($data);
    }

}
