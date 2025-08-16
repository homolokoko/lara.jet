<?php

namespace App\Models\FullQc\Packing;

use App\Models;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Staudenmeir\EloquentHasManyDeep\HasRelationships;

class Profile extends Model
{
    use HasFactory;
    use HasRelationships;

    protected $table = 'fullqc_packing_profile';
    protected $fillable = ['no','location_id','style_profile_id','purchase_order_id','inspected_pcs','repair_pcs','pass_pcs','reject_pcs','inspector_id','reject_rate'];
    public $appends = ['date'];

    public function getDateAttribute()
    {
        return \Carbon\Carbon::parse($this->updated_at)->format('Y-m-d');
    }

    public function items()
    {
        return $this
            ->hasMany(
                Item::class,
                'fullqc_profile_id'
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

    public function style()
    {
        return $this
            ->hasOneDeepFromRelations(
                $this->styleProfile(),
                (new Models\StyleProfile)->style()
            );
    }

    public function location()
    {
        return $this
            ->belongsTo(
                Models\Location::class,
                'location_id'
            );
    }

    public function purchaseOrder()
    {
        return $this
            ->belongsTo(
                Models\PurchaseOrder::class,
                'purchase_order_id'
            );
    }

    public function inspector()
    {
        return $this
            ->belongsTo(
                Models\User::class,
                'inspector_id'
            );
    }

    public function scopeStyle($query, $style)
    {
        $style_profile = Models\StyleProfile::where('style_id',$style)->first();
        return $query->where('style_profile_id',$style_profile->id);
    }

    public function scopeLocate($query, $locate)
    {
        return $query->where('location_id',$locate);
    }

    public function scopeInspector($query, $inspector)
    {
        return $query->where('inspector_id',$inspector);
    }
    public function scopeGetByDate($query,$date)
    {
        switch($date['mode']){
            case 'multiple':
                $multiple = explode(',', $date['value']);
                return $query->whereRaw('DATE(updated_at)', $multiple);
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
