<?php

namespace App\Models\Inspector\Inline;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Repair extends Model
{
    use HasFactory;
    public $table = 'insp_inline_repair';
    protected $fillable = ['insp_inline_item_id', 'insp_inline_defect_id', 'insp_inline_measure_id', 'is_resolve'];
    use \Staudenmeir\EloquentHasManyDeep\HasRelationships;

    public function defect()
    {
        return $this->belongsTo(Defect::class, 'insp_inline_defect_id');
    }
    public function measure()
    {
        return $this->belongsTo(Measure::class, 'insp_inline_measure_id');
    }
    public function item()
    {
        return $this->belongsTo(Item::class, 'insp_inline_item_id');
    }
    public function log()
    {
        return $this->hasMany(RepairLog::class, 'insp_inline_repair_id');
    }
    public function size()
    {
        return $this->hasOneDeepFromRelations(
            $this->item(),
            (new Item)->Sizes()
        );
    }
    public function color()
    {
        return $this->hasOneDeepFromRelations(
            $this->item(),
            (new Item)->Color()
        );
    }
    public function purchaseOrder()
    {

        return $this->hasOneDeepFromRelations(
            $this->item(),
            (new Item)->ProfilePurchaseOrder()
        );
    }
    public function style()
    {

        return $this->hasOneDeepFromRelations(
            $this->item(),
            (new Item)->ProfileStyle()
        );
    }
    public function operator()
    {
        return $this->hasOneDeepFromRelations(
            $this->item(),
            (new Item)->ProfileOperator()
        );
    }
    public function jobseq()
    {
        return $this->hasManyDeepFromRelations(
            $this->item(),
            (new Item)->ProfileJobSeqs()
        );
    }
    public function scopeUnresolved($q)
    {
        return $q->where(['is_resolve' => 0]);
    }
}
