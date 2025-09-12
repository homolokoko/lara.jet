<?php
namespace App\Library\Fullqc\Inspection;

use App\Models\Binticket;
use App\Models\GarmentTracking;
use App\Models\FullQc;
use Illuminate\Support\Arr;
use function PHPUnit\Framework\isEmpty;

class Base{

    public $view_tile,$veiw_type,$mode_title,$mode_type;

    CONST VIEW_FACTORY = 1;
    CONST VIEW_PD = 2;

    public CONST TITLE_FACTORY = 'Factory';
    public CONST TITLE_PD = 'PD';

    public CONST MODE_FULLQC_PACKING = 1;
    public CONST MODE_FULLQC_FINISHING = 2;
    public CONST MODE_FULLQC_AFTERWASH = 3;

    public CONST TITLE_FULLQC_PACKING = 'FullQc Packing';
    public CONST TITLE_FULLQC_FINISHING = 'FullQc Finshing';
    public CONST TITLE_FULLQC_AFTERWASH = 'FullQc After Wash';

    public array $viewType = [
        'pd' => self::VIEW_PD,
        'factory' => self::VIEW_FACTORY,
    ];

    public array $viewTitle = [
        'pd' => self::TITLE_PD,
        'factory' => self::TITLE_FACTORY,
    ];

    public array $modeType = [
        'packing' => self::MODE_FULLQC_PACKING,
        'finishing' => self::MODE_FULLQC_FINISHING,
        'after-wash' => self::MODE_FULLQC_AFTERWASH,
    ];

    public array $modeTitle = [
        'packing' => self::TITLE_FULLQC_PACKING,
        'finishing' => self::TITLE_FULLQC_FINISHING,
        'after-wash' => self::TITLE_FULLQC_AFTERWASH,
    ];

    protected $profile,$item,$itemRepair;

    public function __construct($mode,$report_view) {
        $this->mode_type = Arr::get($this->modeType,$mode);
        $this->mode_title = Arr::get($this->modeTitle,$mode);
        $this->view_type = Arr::get($this->viewType,$report_view);
        $this->view_title = Arr::get($this->viewTitle,$report_view);
    }

    public static function detectGarmentCode($code)
    {
       $bin_number = ['number'=>$code];
       $bin_ticket = Binticket::updateOrCreate($bin_number,$bin_number);
       $garment_code = ['garmentQrCode'=>$code,'bin_tickets_id'=>$bin_ticket->id];
       $garment_ticket = GarmentTracking::updateOrCreate($garment_code,$garment_code);
       $item = FullQc\Item::where('garment_tracking_id',$bin_ticket->id);
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
        $profile = FullQc\Profile::updateOrCreate($data,$data);
         if($status)
                $profile->increment('pass_pcs',1);
            else
                $profile->increment('repair_pcs',1);
        return $profile;
    }

    public static function setItem($data,$status)
    {
        $item = FullQc\Item::updateOrCreate(['garment_tracking_id'=>$data['garment_tracking_id']],$data);
        if($status)
                $item->increment('accept_qty',1);
            else
                $item->increment('reject_qty',1);
        return $item;
    }

    public static function setItemRepair($data)
    {
        return FullQc\ItemRepair::create($data);
    }

    public static function list($style,$locate,$date,$inspector)
    {
        $query = FullQc\Profile::with([
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

    public static function transaction($style,$locate,$date,$inspector)
    {
        $query =  FullQc\Profile::query();
        if($style)
            $query->style($style);
        if($locate)
            $query->locate($locate);
        if($inspector)
            $query->inspector($inspector);
        return $query->getByDate($date)->orderBy('updated_at','desc');
    }



}
