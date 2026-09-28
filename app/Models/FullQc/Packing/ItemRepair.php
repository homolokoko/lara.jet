<?php

namespace App\Models\FullQc\Packing;

use App\Models;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ItemRepair extends Model
{
    use HasFactory;

    protected $table = 'fullqc_packing_item_repair';
    protected $fillable = ['fullqc_item_id','checkpoint_id','defect_id','defect_cause_id','defect_category_id','style_profile_id','style_profile_apparel_id','operator_id'];
    public $appends = ['date'];

    public function getDateAttribute()
    {
        return \Carbon\Carbon::parse($this->updated_at)->format('Y-m-d');
    }

    public function checkpoint()
    {
        return $this
            ->belongsTo(
                Models\Checkpoint::class,
                'checkpoint_id'
            );
    }

    public function defect()
    {
        return $this
            ->belongsTo(
                Models\Defects::class,
                'defect_id'
            );
    }

    public function cause()
    {
        return $this
            ->belongsTo(
                Models\Cause::class,
                'defect_cause_id'
            );
    }

    public function operator()
    {
        return $this
            ->belongsTo(
                Models\User::class,
                'operator_id'
            );
    }

    public function styleProfile()
    {
        return $this
            ->belongsTo(
                Models\StyleProfile::class,
                'style_profile_id'
            );
    }

    public function styleProfileApparel()
    {
        return $this
            ->belongsTo(
                Models\StyleProfile\Apparel::class,
                'style_profile_apparel_id'
            );
    }

    public function scopeGetByDate($query,$date)
    {
         switch($date['mode']){
            case 'multiple':
                $multiple = explode(',', $date['value']);
                return $query->whereRaw('date(updated_at)', $multiple);
                break;
            case 'range':
                $range = explode('to',$date['value']);
                $end = \Carbon\Carbon::parse($range[1])->endOfDay();
                $start = \Carbon\Carbon::parse($range[0])->startOfDay();
                return $query->whereBetween('updated_at',[$start,$end]);
                break;
            case 'single':
                $single = $date['value'];
                return $query->whereDate('updated_at',$single);
                break;
            default:
                return $query->whereDate('updated_at',\Carbon\Carbon::today());
                break;
        }
    }
}
