<?php

namespace App\Models\Inspector\PSMFR;

use App\Http\Controllers\CalculationController;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\Configure;


class Chart extends Model
{
    use HasFactory;
    use \Staudenmeir\EloquentHasManyDeep\HasRelationships;
    protected $table = 'psmfr_chart';
    protected $fillable = [
        'item_id', 'measure_profile_chart_id', 'actual',
        'actual_in_decimal', 'different', 'is_less',
        'is_tally', 'is_more', 'is_accept', 'is_valid', 'measure_tolerance_define_id', 'is_skip'
    ];
    public $timestamps = false;
    protected $appends = ['tally', 'unacceptable', 'withinTolerance', 'status', 'actual_fraction'];

    function getDifferentAttribute($v)
    {
        $cal = new CalculationController();
        return $cal->measureUnitDiff($v);
    }

    function getActualFractionAttribute()
    {
        $cal = new CalculationController();
        $this->actual_in_decimal = abs($this->actual_in_decimal);
        return $cal->decimalToFraction($this->actual_in_decimal);
    }


    function getTallyAttribute()
    {
        if ($this->is_tally) {
            return true;
        }
        return false;
    }

    function getUnacceptableAttribute()
    {
        if (!$this->is_tally && !$this->is_accept) {
            return true;
        }
        return false;
    }

    function getWithinToleranceAttribute()
    { //Within Tolerance
        if (!$this->is_tally && $this->is_accept) {
            return true;
        }
        return false;
    }

    function getStatusAttribute()
    {
        if ($this->is_skip) {
            return 'skip';
        }
        if ($this->is_tally) {
            return 'tally';
        }
        if (!$this->is_tally && $this->is_accept) {
            return 'withinTolerance';
        }
        if (!$this->is_tally && !$this->is_accept) {
            return 'unacceptable';
        }
    }

    function item(): \Illuminate\Database\Eloquent\Relations\BelongsTo
    {
        return $this->belongsTo(Item::class, 'item_id');

    }

    function recordHeader()
    {
        return $this->hasOneDeepFromRelations(
            $this->item(),
            (new Item())->header()
        );
    }

    function referenceChart()
    {
        return $this->belongsTo(Configure\Measure\Profile\Chart::class, 'measure_profile_chart_id');
    }

    function checkpoint()
    {
        return $this->hasOneDeepFromRelations(
            $this->referenceChart(),
            (new Configure\Measure\Profile\Chart)->checkpoint()
        );
    }

    function size()
    {
        return $this->hasOneDeepFromRelations(
            $this->referenceChart(), (new Configure\Measure\Profile\Chart)->sizes());

    }
}
