<?php

namespace App\Models\Inspector\Accessory;

use App\Models\Configure\Accessory\TrimType;
use App\Models\Configure\PurchaseOrders;
use App\Models\Configure\Styles;
use App\Models\Configure\Supplier;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Header extends Model
{
    use HasFactory;
    use \Staudenmeir\EloquentHasManyDeep\HasRelationships;

    public $table="accessory_header";
    protected $fillable = ['no','styles_id','purchase_order_id','trim_type_id',	'supplier_id',	
    'color_id','order_qty','receive_qty','checked_qty','balance_qty',	
    'lot_size','accept','reject','sample','is_pass','image',
    'receive_date','receipt_no'];
    protected $sequences = ['no'];
    protected $dates = ['deleted_at'];

    public function accessoryDefect(){
        return $this->hasMany(Defect::class,'accessory_header_id');
    }
    public function style(){
        return $this->belongsTo(Styles::class,'styles_id');
    }
    public function purchaseOrder(){
        return $this->belongsTo(PurchaseOrders::class,'purchase_order_id');
    }
    public function accessoryType(){
        return $this->belongsTo(TrimType::class,'trim_type_id');
    }
    public function supplier(){
        return $this->belongsTo(Supplier::class,'supplier_id');
    }

   
}
