<?php

namespace App\Models\Inspector\ProductDevelopment\Record\Measurement;

use App\Models\Configure\Color;
use App\Models\Configure\Size;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;
use App\Models\Inspector\ProductDevelopment\Record;
use Illuminate\Support\Arr;
use Illuminate\Support\Carbon;
use Staudenmeir\EloquentHasManyDeep\HasRelationships;

use Illuminate\Database\Eloquent\SoftDeletes;

class Item extends Model
{
    use SoftDeletes;
    use HasFactory;
    use HasRelationships;
    public $table = 'develop_product_record_measure_item';
    protected $fillable = [
        'header_id', 'size', 'color','is_pass',
        'reason'
    ];


    public function chart()
    {
        return $this->hasMany(Chart::class, 'item_id');
    }
    public function colors()
    {
        return $this->belongsTo(Color::class, 'color');
    }
    public function sizes()
    {
        return $this->belongsTo(Size::class, 'size');
    }
    public function header()
    {
        return $this->belongsTo(Record\Header::class, 'header_id');
    }
    public function report()
    {

        return $this->hasOneDeepFromRelations(
            $this->header(),
            (new Record\Header())->report()
        );

    }
    public function scopeDate($q, $v)
    {
        $isArray = ($v) ? Arr::accessible($v) : false;
        $date = (!$v && !$isArray) ? today() : $v;

        if (!$isArray) {
            return $q->where('created_at', '=', $date);
        }

        $getDate = Arr::get($v, 'date', 0);
        if (count($getDate) > 1) {
            list($from, $to) = Arr::get($v, 'date', 0);
            return $q->whereBetween('created_at', [Carbon::parse($from)->timezone('Asia/Phnom_Penh'), Carbon::parse($to)->addDays(1)->timezone('Asia/Phnom_Penh')]);
        } else {
            $from = Carbon::parse(Arr::get($getDate, '0'))->timezone('Asia/Phnom_Penh')->startOfDay()->format('Y-m-d H:i:s');
            $to = Carbon::parse(Arr::get($getDate, '0'))->timezone('Asia/Phnom_Penh')->endOfDay()->format('Y-m-d H:i:s');
            debug($v, Arr::get($getDate, '0'), $from, $to);
            return $q->whereBetween('created_at', [$from,$to]);
        }

    }
    public function scopeSummary($q)
    {
        return $q;
    }

    public function scopePassFailStats($q)
    {
        return $q->select('header_id', DB::raw('sum(is_pass) as pass, sum(if(is_pass = 0, 1,0 )) as failed, count(is_pass) as total'))->groupBy('header_id');
    }
    /* ----------------------------- Extra Function ----------------------------- */
    public function isSameDate($date) //check is single (true) or date range (false)
    {
        list($first, $end) = Arr::get($date, 'date', 0);
        return Carbon::parse($first)->equalTo($end);
    }

}
