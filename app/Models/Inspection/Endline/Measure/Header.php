<?php

namespace App\Models\Inspector\Endline\Measure;

use App\Http\Livewire\Inspector\ProductDevelopment\Form\Measurement\Profile as MeasurementProfile;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\Configure\Measure\Profile;
use App\Models\Configure\Styles;
use App\Models\Configure\WorkstationLocate;
use App\Models\User;
use App\Models\Configure\PurchaseOrders;
use Illuminate\Support\Arr;
use Illuminate\Support\Carbon;
use Staudenmeir\EloquentHasManyDeep\HasRelationships;

class Header extends Model
{
    use HasFactory;
    use HasRelationships;

    public $table = "endline_measure_header";
    protected $fillable = [
        'style_id',
        'locate_id',
        'date',
        'purchase_orders_id',
        'measure_profile_header_id',
        'inspected_garment_qty',
        'total_checkpoint_checked',
        'total_checkpoint_acceptable',
        'total_checkpoint_less',
        'total_checkpoint_more',
        'total_checkpoint_tally',
        'inspector_id'
    ];

    public function item()
    {
        return $this->hasMany(Item::class, 'header_id');
    }
    public function measureHeader()
    {
        return $this->belongsTo(Profile\Header::class, 'measure_profile_header_id');
    }
    public function locate()
    {
        return $this->belongsTo(WorkstationLocate::class, 'locate_id');
    }
    public function style()
    {
        return $this->belongsTo(Styles::class, 'style_id');
    }
    public function inspector()
    {
        return $this->belongsTo(User::class, 'inspector_id');
    }
    public function purchaseOrder()
    {
        return $this->belongsTo(PurchaseOrders::class, 'purchase_orders_id');
    }
    public function version()
    {
        return $this->hasOneDeepFromRelations($this->measureHeader(), (new Profile\Header)->version());
    }

    public function checkpoints()
    {
        return $this->hasManyDeepFromRelations(
            $this->measureHeader(),
            (new Profile\Header)->detail()
        );
    }

    public function auditCharts()
    {
        return $this
            ->hasManyDeepFromRelations(
                $this->item(),
                (new Item)->chart()
            );
    }

    public function scopeFilterDate($query, $date)
    {
        list($start, $end) =  Arr::get($date, 'date');
        $start = Carbon::parse($start);
        $end = Carbon::parse($end);
        if ($start->isSameDay($end)) {
            return $query->whereDate('created_at', $start->format('Y-m-d'));
        } else {
            return $query->whereDate('created_at', '>=', $start->format('Y-m-d'))->whereDate('created_at', '<=', $end->format('Y-m-d'));
        }
    }

    public function scopeStyle($query, $style)
    {
        return $query->where('style_id', $style);
    }

    public function scopeGetStyle($query, $style)
    {
        return $query->where('style_id', $style);
    }

    public function scopeValidInfo($query)
    {
        return $query->whereHas('item');
    }

}
