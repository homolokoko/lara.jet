<?php

namespace App\Models\Inspector\Endline\Measure\ReturnGarment;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\Configure\Measure\Profile;
use App\Http\Controllers\CalculationController;

class Chart extends Model
{
    use HasFactory;
    public $table = "endline_measure_return_chart";
    protected $fillable = [
        'repair_header_id', 'measure_profile_chart_id',
        'actual', 'actual_in_decimal', 'different', 'is_less', 'is_tally',
        'is_more', 'is_accept', 'is_valid', 'measure_tolerance_define_id',
    ];
    protected $appends = ['diffFrac'];
    public $timestamps = false;
    //
    function getDiffFracAttribute()
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
    function chart()
    {
        return $this->belongsTo(Profile\Chart::class, 'measure_profile_chart_id');
    }
    function checkpoint()
    {
        return $this->hasOneDeepFromRelations(
            $this->chart(),
            (new Profile\Chart)->detail()
        );
        //detail
        //return $this->belongsTo(Profile\Detail::class, 'measure_profile_chart_id');
    }
}
