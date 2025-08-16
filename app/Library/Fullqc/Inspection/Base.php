<?php
namespace App\Library\Fullqc\Inspection;

use App\Models\Binticket;
use App\Models\GarmentTracking;
use App\Models\FullQc\{Afterwash,Packing,Finishing};

class Base{

    protected $profile,$item,$itemRepair;

    public function __construct($module) {
        switch($module)
        {
            case 'packing':
                $this->profile = Packing\Profile::class;
                $this->item = Packing\Item::class;
                $this->itemRepair = Packing\ItemRepair::class;
                break;
            case 'afterwash':
                $this->profile = Afterwash\Profile::class;
                $this->item = Afterwash\Item::class;
                $this->itemRepair = Afterwash\ItemRepair::class;
                break;
            case 'finishing':
                $this->profile = Finishing\Profile::class;
                $this->item = Finishing\Item::class;
                $this->itemRepair = Finishing\ItemRepair::class;
                break;
            default:
                break;

        }
    }

    public function detectGarmentCode($code)
    {
       $bin_number = ['number'=>$code];
       $bin_ticket = Binticket::updateOrCreate($bin_number,$bin_number);
       $garment_code = ['garmentQrCode'=>$code,'bin_tickets_id'=>$bin_ticket->id];
       $garment_ticket = GarmentTracking::updateOrCreate($garment_code,$garment_code);
       $item = $this->item::where('garment_tracking_id',$bin_ticket->id);
       if($item->exists()){
            $alert_message = [
                'icon'=>'error',
                'title'=>'Existed',
                'text'=>'Do you want to override existing record?',
                'showDenyButton'=>true,
            ];
       }else{
            $alert_message = [
                'icon'=>'success',
                'title'=>'Recorded',
                'text'=>'You can continue scanning in a second.',
                'timer'=>1000,
                'tiimerProgressBar'=>true,
                'showConfirmButton'=>false,
            ];
       }
       return ['garment_tracking_id'=>$bin_ticket->id,'existed'=>$item->exists(),'alert_message'=>$alert_message];
    }

    public function setProfile($data,$status)
    {
        $profile = $this->profile::updateOrCreate($data,$data);
         if($status)
                $profile->increment('pass_pcs',1);
            else
                $profile->increment('repair_pcs',1);
        return $profile;
    }

    public function setItem($data,$status)
    {
        $item = $this->item::updateOrCreate(['garment_tracking_id'=>$data['garment_tracking_id']],$data);
        if($status)
                $item->increment('accept_qty',1);
            else
                $item->increment('reject_qty',1);
        return $item;
    }

    public function setItemRepair($data)
    {
        return $this->itemRepair::create($data);
    }

    public function list($style,$locate,$date,$inspector)
    {
        $query = $this->profile::with([
                'style',
                'location',
                'purchaseOrder',
                'inspector',
                'items',
                'items.size',
                'items.color',
                'items.garment',
                'items.repairs',
                'items.repairs.defect',
                'items.repairs.cause',
                'items.repairs.checkpoint',
                'items.repairs.operator',
        ]);
        if($style) $query->style($style);
        if($locate) $query->locate($locate);
        if($inspector)  $query->inspector($inspector);
        if($date) $query->getByDate($date);
        return $query->orderBy('updated_at','desc')->get();
    }

    public function transaction($style,$locate,$date,$inspector)
    {
        $query = $this->item::with([
            'size',
            'color',
            'garment',
            'style',
            'location',
            'inspector'
        ]);
        return $query->orderBy('updated_at','desc');
    }



}
