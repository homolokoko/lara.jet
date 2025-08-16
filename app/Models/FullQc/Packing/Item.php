<?php

namespace App\Models\FullQc\Packing;

use App\Models;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Staudenmeir\EloquentHasManyDeep\HasRelationships;

class Item extends Model
{
    use HasFactory;
    use HasRelationships;

    protected $table = 'fullqc_packing_item';
    protected $fillable = ['item_no','fullqc_profile_id','size_id','color_id','is_pass','is_repair','is_acceptable','accept_qty','reject_qty','garment_tracking_id'];
    public $appends = ['date'];

    public function getDateAttribute()
    {
        return \Carbon\Carbon::parse($this->updated_at)->format('d/m/y');
    }

    public function size()
    {
        return $this
            ->belongsTo(
                Models\Size::class,
                'size_id'
            );
    }

    public function color()
    {
        return $this
            ->belongsTo(
                Models\Color::class,
                'color_id'
            );
    }

    public function garment()
    {
        return $this
            ->belongsTo(
                Models\GarmentTracking::class,
                'garment_tracking_id'
            );
    }

    public function profile()
    {
        return $this
            ->belongsTo(
                Profile::class,
                'fullqc_profile_id'
            );
    }

    public function style()
    {
        return $this
            ->hasOneDeepFromRelations(
                $this->profile(),
                (new Profile)->style()
            );
    }

    public function location()
    {
        return $this
            ->hasOneDeepFromRelations(
                $this->profile(),
                (new Profile)->location()
            );
    }

    public function inspector()
    {
        return $this
            ->hasOneDeepFromRelations(
                $this->profile(),
                (new Profile)->inspector()
            );
    }

    public function repairs()
    {
        return $this
            ->hasMany(
                ItemRepair::class,
                'fullqc_item_id'
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
