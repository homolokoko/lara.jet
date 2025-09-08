<?php

namespace App\Models\Inspector\ProductDevelopment\Record;

use App\Models\Configure\ProductDevelopment\InspectionType;
use App\Models\Configure\Buyers;
use App\Models\Configure\ProductDevelop\ReportType;
use App\Models\Configure\Styles;
use App\Models\Configure\Version;
use App\Models\Inspector\ProductDevelopment\Record\Measurement\Chart;
use App\Models\User;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Arr;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\DB;
use Illuminate\Database\Eloquent\SoftDeletes;
use Vicklr\MaterializedModel\MaterializedModel;

class Header extends MaterializedModel
{
    use HasFactory;
    use \Staudenmeir\EloquentHasManyDeep\HasRelationships;
    use SoftDeletes;

    public $table = 'develop_product_record_header';
    protected $fillable = [
        'report_date', 'is_complete', 'inspector_id', 'version_id', 'buyer_id', 'styles_id', 'type_id','is_pass',
        'inspection_type_id','sample_type_id',
        'parent_id','sort','path','depth',
        'reason'
    ];
    protected $appends = [
        'measurement_result',
        'checklist_result',
    ];
    protected $casts = [
        'measurement_result' => 'string',
        'checklist_result' => 'string',
    ];

    /* ------------------------------ Relationship ------------------------------ */
    public function detail()
    {
        return $this->hasMany(Detail::class, 'header_id');
    }
    public function measurementItem()
    {
        return $this->hasManyDeepFromRelations(
            $this->measureProfile(),
            (new Measurement\Reference())->item());
        //return $this->hasMany(Measurement\Item::class, 'header_id');
    }
    public function measureProfile()
    {
        return $this->hasMany(Measurement\Reference::class, 'header_id');
    }
    public function measureItemChart()
    {
        return $this->hasManyDeepFromRelations(
            $this->measurementItem(),
            (new Measurement\Item())->chart()
        );
    }


    public function buyer()
    {
        return $this->belongsTo(Buyers::class, 'buyer_id');
    }
    public function style()
    {
        return $this->belongsTo(Styles::class, 'styles_id');
    }
    public function report()
    {
        return $this->belongsTo(ReportType::class, 'type_id');
    }
    public function inspector()
    {
        return $this->belongsTo(User::class, 'inspector_id');
    }
    public function inspectionType()
    {
        return  $this->belongsTo(InspectionType::class, 'inspection_type_id');
    }
    public function sampleType()
    {
        return $this->belongsTo(Version::class, 'sample_type_id');
    }

    /* ---------------------------------- Attributes ---------------------------------- */
    public function getMeasurementResultAttribute(){
       if(count($this->measureProfile) > 0){
           $item = $this->measureProfile->pluck('item')->flatten();
           $itemStatus = $item->map(function($item){
               $getFailCheckpoint = $item->chart->filter(function ($checkPoint) {
                   return $checkPoint->is_accept == 0 && $checkPoint->is_skip == 0;
               });
               return ($getFailCheckpoint->count() > 0) ? 'fail' : 'pass';
           });
           $lastItem = $itemStatus->last();
           if($this->is_pass !==  $lastItem){
               if($itemStatus->last() == 'fail'){
                   $this->is_pass = 0;
                   $this->save();
               }elseif($itemStatus->last() == 'pass'){
                   $this->is_pass = 1;
                   $this->save();
               }
           }


           return $itemStatus->last();
       }else{
           return -1;
       }
    }
    public function getChecklistResultAttribute(){
        if(count($this->detail) > 0){
            $requireFail = 0;
            $getFailCheckpointCount =$this->detail->filter(function ($detail){
                return $detail->status == 0 ;
            })->flatten(1)->count();
            $isFail = ($getFailCheckpointCount > $requireFail)? 'fail' : 'pass';
            if($isFail !== $this->is_pass){
                if($isFail == 'fail'){
                    $this->is_pass = 0;
                    $this->save();
                }elseif($isFail == 'pass'){
                    $this->is_pass = 1;
                    $this->save();
                }
            }
            return $isFail;
        }else{
            return -1;
        }
    }

    /* ---------------------------------- SCOPE --------------------------------- */
    public function scopeRecordId($q, $v)
    {
        return $q->where(['id' => $v]);
    }
    public function scopeFilterStyles($q,$search)
    {
        dd($search);
        $searchTerm = '%' . $search . '%';
        return $q->where('style.name', 'like', $searchTerm);
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
    public function scopePatternAndSample($q)
    {
        return $q->where('type_id', '=', 2);
    }
    public function scopeFittingCheck($q)
    {
        return $q->where('type_id', '=', 1);
    }
    public function scopeMeasurement($q)
    {
        return $q->where('type_id', '=', 3);
    }

    public function scopePatternAndSampleStats($q)
    {
        return  $q->select('type_id',
            DB::raw('sum(is_pass) as pass,
            sum(if(is_pass = 0, 1,0 )) as failed,
            count(is_pass) as total'
            ))->where('type_id', '=', 2)->groupBy('type_id');
    }
    public function scopeFittingCheckStats($q)
    {
        return  $q->select('type_id',
            DB::raw('sum(is_pass) as pass,
            sum(if(is_pass = 0, 1,0 )) as failed,
            count(is_pass) as total'
            ))->where('type_id', '=', 1)->groupBy('type_id');
    }
    public function scopeFilterPassFail($q,$v){
        $convert = ($v === 'Passed')? 1 : 0;

        return $q->where('is_pass', '=', $convert);
    }
    function scopeFilterInspectionType($q,$v)
    {
        return $q->where('develop_product_inspection_type.name', '=', $v);
    }
    function scopeGetDate($q,$v){
        return $q->whereDate('report_date','=', Carbon::parse($v)->format('Y-m-d'));
    }

    /* ----------------------------- Extra Function ----------------------------- */
    public function isSameDate($date) //check is single (true) or date range (false)
    {
        list($first, $end) = Arr::get($date, 'date', 0);
        return Carbon::parse($first)->equalTo($end);
    }
}
