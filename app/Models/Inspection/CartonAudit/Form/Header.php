<?php

namespace App\Models\Inspector\CartonAudit\Form;

use App\Models\Configure\PurchaseOrders;
use App\Models\Configure\Styles;
use App\Models\Configure\Workstations;
use App\Models\User;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Support\Carbon;

class Header extends Model
{
    use HasFactory;
    use SoftDeletes;
    use \Staudenmeir\EloquentHasManyDeep\HasRelationships;

    public $table="carton_audit_form_header";

    protected $fillable = [
        'doc_no','style_id','workstation_id','purchase_order_id',
        'no_piece_per_ctn','passed_garment_pcs',
        'fail_garment_pcs','is_pass','is_complete',
        'carton_no','ratio','color_id'
    ];
    
    protected $sequences = ['doc_no'];
    protected $dates = ['deleted_at'];
    protected $appends = ['weekOfYear'];

    public function detail(){
        return $this->hasMany(Detail::class,'carton_audit_form_header_id');
    }
    public function workstation(){
        return $this->belongsTo(Workstations::class,'workstation_id');
    }
    public function style(){
        return $this->belongsTo(Styles::class,'style_id');
    }
    public function purchaseOrder(){
        return $this->belongsTo(PurchaseOrders::class,'purchase_order_id');
    }
    public function inspector(){
        return $this->hasManyThrough(
            User::class,
            Inspector::class,
            'inspector_id',
            'id',
        );
    }
    public function scopeCtnPass($query)
    {
        return $query->where(['is_pass'=>1]);
    }
    public function scopeCtnReject($query)
    {
        return $query->where(['is_pass'=>0]);
    }
    public function scopeCtnComplete($query){
        return $query->where(['is_complete'=>1]);
    }
    public function scopeCheckedPiece($query){
        return $query->where(['is_complete'=>1])->sum('no_piece_per_ctn');
    }
    public function getIsCompleteAttribute($v)
    {
        return ($v)? 'Complete' : 'Inspection Processing';
        /**($value){   
        dd($value);
        } */
    }
    public function defect(){
        return $this->hasManyDeepFromRelations(
            $this->detail(), (new detail)->defect()
        );
    }
    public function getWeekOfYearAttribute(){
        return Carbon::parse($this->created_at)->weekOfYear;
    }
    
}
