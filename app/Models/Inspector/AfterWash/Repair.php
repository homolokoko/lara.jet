<?php

namespace App\Models\Inspector\AfterWash;

use App\Models\Configure\WorkstationLocate;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Carbon;

use App\Models\GarmentTracking\Main as GarmentTracking;
use Staudenmeir\EloquentHasManyDeep\HasRelationships;

class Repair extends Model
{
    use HasFactory;
    use HasRelationships;
    public $table = 'insp_afterwash_repair';
    protected $fillable = [
        'insp_item_id', 'identity_card_id', 'is_resolve', 'insp_item_defect_id',
        'from_locate', 'to_locate','rework_id'
    ];

    public function locate()
    {
        return $this->belongsTo(WorkstationLocate::class, 'from_locate');
    }
    public function fromLocate()
    {
        return $this->belongsTo(WorkstationLocate::class, 'from_locate');
    }
    public function toLocate()
    {
        return $this->belongsTo(WorkstationLocate::class, 'to_locate');
    }

    public function item()
    {
        return $this->belongsTo(Item::class, 'insp_item_id');
    }
    public function inspector()
    {
        return $this->hasOneDeepFromRelations(
            $this->item(),
            (new item())->inspector()
        );

    }

    public function garmentIssue()
    {
        return $this->belongsTo(ItemDefect::class, 'insp_item_defect_id');
    }
    public function scopeQrCode($q, $v)
    {
        return $q->where('identity_card_id', '=', $v);
    }
    public function scopeCaseClose($q)
    {
        return $q->where('is_resolve', '=', 1);
    }
    public function scopeCaseOpen($q)
    {
        return $q->where('is_resolve', '=', 0);
    }
    public function defects()
    {
        return $this->hasOneDeepFromRelations(
            $this->garmentIssue(),
            (new ItemDefect())->defect()
        );
    }
    public function checkpoint()
    {
        return $this->hasOneDeepFromRelations(
            $this->garmentIssue(),
            (new ItemDefect())->checkpoint()
        );
    }
    public function cause()
    {
        return $this->hasOneDeepFromRelations(
            $this->garmentIssue(),
            (new ItemDefect())->cause()
        );
    }
    public function scopeDate($q, $v)
    {
        $date = (!$v) ? today() : $v;
        return $q->whereDate('created_at', Carbon::today());
    }

    public function garmentTracking()
    {
        return $this
            ->belongsTo(GarmentTracking::class,'identity_card_id');
    }
}
