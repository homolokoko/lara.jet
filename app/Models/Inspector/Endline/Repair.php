<?php

namespace App\Models\Inspector\Endline;

use App\Models\Configure\Workstations;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\Inspector\Endline\Defect as EndlineDefect;
use App\Models\Supervisor\ActionTaken;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Support\Arr;
use Staudenmeir\EloquentHasManyDeep\HasRelationships;

class Repair extends Model
{
    use HasFactory;
    use SoftDeletes;
    use HasRelationships;

    public $table = 'insp_endline_repair';
    protected $fillable = [
        'insp_endline_item_id', 'is_resolve', 'identity_card_id', 'insp_endline_defect_id', 'rework_id'
    ];

    public function item()
    {
        return $this->belongsTo(Item::class, 'insp_endline_item_id');
    }

    public function log()
    {
        return $this->hasMany(RepairLog::class, 'insp_endline_repair_id');
    }
    public function defect()
    {
        return $this->hasManyDeepFromRelations($this->item(),
            (new item)->defect());
        //return $this->belongsTo(EndlineDefect::class, 'insp_endline_defect_id');
    }
    public function locate()
    {
        return $this->hasOneDeepFromRelations(
            $this->profile(),
            (new Profile)->locate()
        );
    }

    public function defectEndlineRecord()
    {
        return $this->hasManyDeepFromRelations( $this->item(), (new item)->defect());
    }
    public function color()
    {
        return $this->hasOneDeepFromRelations(
            $this->item(),
            (new item)->color()
        );
    }
    public function sizes()
    {
        return $this->hasOneDeepFromRelations(
            $this->item(),
            (new item)->sizes()
        );
    }
    public function style()
    {
        return $this->hasOneDeepFromRelations(
            $this->item(),
            (new item)->style()
        );
    }
    public function purchaseOrder()
    {
        return $this->hasOneDeepFromRelations(
            $this->item(),
            (new item)->purchaseOrder()
        );
    }



    public function defects()
    {
        return $this->hasManyDeepFromRelations(
            $this->defectEndlineRecord(),
            (new EndlineDefect)->defectname()
        );
    }
    public function checkpoint()
    {
        return $this->hasManyDeepFromRelations(
            $this->defectEndlineRecord(),
            (new EndlineDefect)->checkpointName()
        );
    }
    public function cause()
    {
        return $this->hasManyDeepFromRelations(
            $this->defectEndlineRecord(),
            (new EndlineDefect)->defectCause()
        );
    }
    public function actionTaken(){
        return $this->hasOne(ActionTaken\Endline\Header::class,'repair_id');
    }
    public function profile(){
        return $this->hasOneDeepFromRelations(
            $this->item(),
            (new item)->profile()
        );
    }
    public function inspector(){
        return $this->hasOneDeepFromRelations(
            $this->profile(),
            (new profile)->inspector()
        );
    }


    public function scopeSpecifyDate($q,$v){
        return $q->whereDate('created_at', $v);
    }
    public function scopeCase($q,$v){
        return $q->where('id','=',$v);
    }



}
