<?php

namespace App\Models\Inspector\CartonAudit;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\Configure\Styles;
use App\Models\Configure\PurchaseOrders;
use App\Models\User;
use Illuminate\Database\Eloquent\SoftDeletes;

class Header extends Model
{
    use HasFactory;
    use SoftDeletes;

    public $table="ctn_audit_header";
    protected $fillable = ['style_id','purchase_order_id','no','inspector_id'];
    protected $sequences = ['no'];
    protected $dates = ['deleted_at'];

    public function detail(){
        return $this->hasMany(detail::class,'ctn_audit_header_id');
    }
    public function style(){
        return $this->belongsTo(Styles::class,'style_id');
    }
    public function purchaseOrder(){
        return $this->belongsTo(PurchaseOrders::class,'purchase_order_id');
    }
    public function inspector(){
        return $this->belongsTo(User::class, 'inspector_id');
    }
}
