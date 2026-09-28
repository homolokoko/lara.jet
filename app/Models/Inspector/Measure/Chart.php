<?php

namespace App\Models\Inspector\Measure;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\Configure\Measure\Profile\Chart as SetupMeasureChart;
use App\Models\Configure\Measure\Profile\Detail as SetupMeasureDetail;
use Brick\Math\BigDecimal;
use Illuminate\Support\Carbon;
use App\Models\Tolerance\Category as ToleranceCategory;

class Chart extends Model
{
    use HasFactory;
    use \Staudenmeir\EloquentHasManyDeep\HasRelationships;
    public $table = "insp_measure_chart";
    protected $appends = ['displayDifferent', 'timestamp'];
    protected $fillable =
    [
        'insp_measure_item_id',
        'measure_profile_chart_id',
        'actual', 'actual_in_decimal', 'different',
        'is_more', 'is_less', 'is_accept', 'is_tally',
        'measure_tolerance_define_id'
    ];
    protected $casts = [
        "is_less" => "boolean",
        "is_tally" => "boolean",
        "is_more" => "boolean",
        "is_accept" => "boolean",
        "actual_in_decimal" => "float",
        "different" => "float",

    ];

    public function toleranceDefine()
    {
        return $this->belongsTo(ToleranceCategory::class, 'measure_tolerance_define_id');
    }
    public function setupMeasureChart()
    {
        // return $this->hasManyThrough(configureMeasureChart::class, 'App\User');
        return $this->belongsTo(SetupMeasureChart::class, 'measure_profile_chart_id');
    }
    public function item()
    {
        return $this->belongsTo(item::class, 'insp_measure_item_id');
    }
    public function size()
    {
        return $this->hasOneDeepFromRelations(
            $this->item(),
            (new Item)->size()
        );
    }
    public function checkpoint()
    {
        return $this->hasOneDeepFromRelations(
            $this->setupMeasureChart(),
            (new SetupMeasureChart)->checkpoint()
        );
    }
    public function inspect()
    {
        return $this->hasOneDeepFromRelations(
            $this->item(),
            (new Item)->header()
        );
    }
    public function measureProfile()
    {
        return $this->hasOneDeepFromRelations(
            $this->item(),
            (new Item)->headerProfile()
        );
    }

    public function getDisplayDifferentAttribute()
    {
        if ($this->is_less) {
            return BigDecimal::of(0)->minus($this->different)->__toString();
        }
        return $this->different;
    }
    function getTimestampAttribute()
    {
        return  Carbon::parse($this->created_date)->timestamp;
    }
}
