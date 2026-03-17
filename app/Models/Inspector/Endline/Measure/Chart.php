<?php

namespace App\Models\Inspector\Endline\Measure;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Http\Controllers\CalculationController;
use App\Models\Configure\Measure\Profile;
use App\Models\Inspector\Endline\Measure\Item;
use Staudenmeir\EloquentHasManyDeep\HasRelationships;

class Chart extends Model
{
    use HasFactory;
    use HasRelationships;

    public $table = "endline_measure_chart";
    protected $fillable = [
        'inspection_measure_item_id', 'measure_profile_chart_id',
        'actual', 'actual_in_decimal', 'different', 'is_less', 'is_tally',
        'is_more', 'is_accept', 'is_valid', 'measure_tolerance_define_id',
    ];
    protected $appends = ['diffFrac', 'is_fail', 'is_pass'];
    public $timestamps = false;

    public function getDiffFracAttribute()
    {
        $calc = new CalculationController();
        $diff = $calc->decimalToFraction($this->different);
        //

        if ($this->is_more) {
            $plusOrMinus = '+';
        }
        if ($this->is_less) {
            $plusOrMinus = '-';
        }
        if ($this->is_tally) {
            $plusOrMinus = '';
        }
        return $plusOrMinus . $diff;
    }

    public function chart()
    {
        return $this->belongsTo(Profile\Chart::class, 'measure_profile_chart_id')->withTrashed();
    }

    public function checkpoint()
    {
        return $this->hasOneDeepFromRelations(
            $this->chart(),
            (new Profile\Chart)->detail()
        );
        //detail
        //return $this->belongsTo(Profile\Detail::class, 'measure_profile_chart_id');
    }

    public function items()
    {
        return $this->belongsTo(Item::class, 'inspection_measure_item_id');
    }

    public function style()
    {
        return $this->hasOneDeepFromRelations(
            $this->items(),
            (new Item)->style()
        );
    }

    public function size()
    {
        return $this->hasOneDeepFromRelations(
            $this->items(),
            (new Item)->size()
        );
    }

    public function reportDate()
    {
        return $this->hasOneDeepFromRelations(
            $this->items(),
            (new Item)->header()
        );
    }

    public function getIsFailAttribute()
    {
        return (float) $this->different >= 1;
    }

    public function getIsPassAttribute()
    {
        return (float) $this->different < 1;
    }
}
