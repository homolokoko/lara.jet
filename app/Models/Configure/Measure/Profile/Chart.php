<?php

namespace App\Models\Configure\Measure\Profile;

use App\Http\Controllers\CalculationController;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\Configure\Size;
use App\Models\Configure\Measure\Profile\Detail as Checkpoint;
use App\Models\Inspector\Measure\Chart as Inspection;
use App\Models\Inspector\Endline\Measure;
use Brick\Math\BigDecimal;
use Brick\Math\BigRational;
use App\Models\Auditor\Inspection\Measurement\Chart as AuditorChart;
use App\Traits\FileVer;
use Illuminate\Database\Eloquent\SoftDeletes;
use Staudenmeir\EloquentHasManyDeep\HasRelationships;
use Str;
use App\Models\Configure\PSMFR\Shrinkage;

class Chart extends Model
{
    use FileVer;

    use SoftDeletes;
    use HasFactory;
    use HasRelationships;


    protected $touches = ['header'];

    protected $fillable = ['sizes_id', 'tolerance_min', 'tolerance_max', 'expected_value', 'measure_profile_detail_id'];
    protected $table = 'measure_profile_chart';
    protected $appends = ['tolmin', 'tolmax', 'expected_fraction'];

    public function detail()
    {
        return $this->belongsTo(Detail::class, 'measure_profile_detail_id');
    }
    public function header()
    {
        return $this->hasOneDeepFromRelations(
            $this->detail(),
            (new Detail)->header()
        );
    }

    public function sizes()
    {
        return $this->belongsTo(Size::class, 'sizes_id');
    }
    public function checkpoint()
    {
        return $this->belongsTo(Checkpoint::class, 'measure_profile_detail_id');
    }
    public function inspection()
    {
        return $this->hasMany(Inspection::class, 'measure_profile_chart_id');
    }
    public function auditor()
    {
        return $this->hasMany(AuditorChart::class, 'measure_profile_chart_id');
    }
    function is_decimal($val)
    {
        return is_numeric($val) && floor($val) != $val;
    }
    public function getTolMinAttribute()
    {
        if (!$this->is_decimal($this->tolerance_min)) {
            return $this->checkFraction($this->tolerance_min);
        } else {
            return $this->tolerance_min;
        }
    }
    public function getTolMaxAttribute()
    {
        if (!$this->is_decimal($this->tolerance_max)) {
            return $this->checkFraction($this->tolerance_max);
        } else {
            return $this->tolerance_max;
        }
    }
    public function checkFraction($value)
    {
        $re = '/^ *(\d+)[- ]+(\d+) *\/ *(\d)+(\D.*)?$/';
        preg_match($re, $value, $matches);
        if (count($matches) > 1) {
            $num = Str::of($value)->split('/[- ]/');
            $bigNum = BigDecimal::of($num[0]);
            $result = BigRational::of($num[1])->plus($bigNum)->toBigDecimal()->__toString();
        } else {
            $result = BigRational::of($value)->toBigDecimal()->__toString();
        }

        return $result;
    }
    public function getExpectedFractionAttribute()
    {
        $cal = new CalculationController();
        $expectedValue = $this->checkFraction($this->expected_value);
        return $cal->decimalToFraction($expectedValue);
    }

    public function endlineMeasureChart()
    {
        return $this->hasMany(Measure\Chart::class, 'measure_profile_chart_id');
    }
    public function scopeForSizeAndCheckpoints($query, $size, $checkpointIdArray)
    {
        return $query->withTrashed()->where('sizes_id', $size)->whereIn('measure_profile_detail_id', $checkpointIdArray);
    }
}
