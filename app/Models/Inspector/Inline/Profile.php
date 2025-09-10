<?php

namespace App\Models\Inspector\Inline;

use App\Models\Configure\Defects;
use App\Models\Configure\JobSeqs;
use App\Models\Configure\PurchaseOrders;
use App\Models\Configure\Workstations;
use App\Models\Inspector\Inline\Item;
use App\Models\User;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use App\Models\Configure\Style\Profile as StyleProfile;
use Illuminate\Support\Arr;
use Illuminate\Support\Carbon;
use Staudenmeir\EloquentHasManyDeep\HasRelationships;

class Profile extends Model
{
    use HasFactory;
    use SoftDeletes;
    use HasRelationships;

    public $table = 'insp_inline_profile';
    protected $fillable = [
        'no',
        'purchase_order_id', 'inspected_pcs', 'repair_pcs', 'damage_pcs', 'pass_pcs', 'is_green', 'is_yellow', 'is_red',
        'inspector_id',
        'style_profile_id',
        'operator_id',
        'sample_size_pcs',
        'module',
    ];
    protected $sequences = ['no'];
    protected $dates = ['deleted_at'];
    protected $appends = ['weekOfYear', 'flag', 'time', 'station','reportDate'];

    public function operator()
    {
        return $this->hasManyThrough(
            User::class,
            Operator::class,
            'insp_inline_profile_id',
            'id',
            'id',
            'operator_id'
        );
    }


    public function InlineWorkstation()
    {
        return $this->hasManyThrough(
            Workstations::class,
            Workstation::class,
            'insp_inline_profile_id',
            'id',
            'id',
            'workstation_id'
        );
    }
    public function operatorList()
    {
        return $this->hasMany(Operator::class, 'insp_inline_profile_id');
    }

    public function Workstation()
    {
        return $this->hasMany(Workstation::class, 'insp_inline_profile_id');
    }
    public function purchaseOrder()
    {
        return $this->belongsTo(PurchaseOrders::class, 'purchase_order_id');
    }
    public function Item()
    {
        return $this->hasMany(Item::class, 'insp_inline_profile_id');
    }
    public function problem()
    {
        return $this->hasManyDeepFromRelations(
            $this->item(),
            (new Item())->defect()
        );
    }

    public function InlineJobSeq()
    {
        return $this->hasManyThrough(
            JobSeqs::class,
            Jobseq::class,
            'insp_inline_profile_id',
            'id',
            'id',
            'jobseq_id'
        );
    }
    public function inspector()
    {
        return $this->belongsTo(User::class, 'inspector_id');
    }
    public function styleProfile()
    {
        return $this->belongsTo(StyleProfile::class, 'style_profile_id');
    }
    public function style()
    {
        return $this->hasOneDeepFromRelations(
            $this->styleProfile()->withTrashed(),
            (new StyleProfile())->styles()->withTrashed()
        );
    }
    public function version()
    {
        return $this->hasOneDeepFromRelations(
            $this->styleProfile(),
            (new StyleProfile())->version()
        );
    }
    public function size()
    {
        return $this->hasOneDeepFromRelations(
            $this->styleProfile(),
            (new StyleProfile())->sizeName()
        );
    }
    public function color()
    {
        return $this->hasOneDeepFromRelations(
            $this->styleProfile(),
            (new StyleProfile())->colorsName()
        );
    }
    public function apparel()
    {
        return $this->hasOneDeepFromRelations(
            $this->styleProfile(),
            (new StyleProfile())->apparelName()
        );
    }


    public function locate()
    {
        return $this->hasOneDeepFromRelations(
            $this->Workstation(),
            (new Workstation())->locate()
        );
    }

    public function recordCheckList()
    {
        return $this->hasMany(
            CheckList::class,
            'profile_id'
        );
    }

    public function getWeekOfYearAttribute()
    {
        return Carbon::parse($this->created_at)->weekOfYear;
    }
    public function getStationAttribute()
    {
        $job = $this->InlineJobSeq()->withTrashed()->get()->first();
        $operation_id = ($job) ? $job->id : '';
        $operation_name = ($job) ? $job->name : '';
        $operation_no = ($job) ? $job->no : '';
        $operation = ['id' => $operation_id, 'name' => $operation_name, 'no' => $operation_no];

        $locate = $this->locate()->get()->first();
        $locate_id = ($locate) ? $locate->id : '';
        $locate_name =  ($locate) ? $locate->name : '';
        $line = ['id' => $locate_id, 'name' => $locate_name];
        return $this->InlineWorkstation()->get()->pluck('name', 'id')->mapWithKeys(function ($station_name, $station_id) use ($line, $operation) {
            return [
                'station_id' => $station_id,
                'station' => $station_name,
                'locate_id' => $line['id'],
                'locate_name' =>  $line['name'],
                'operation_id' =>  $operation['id'],
                'operation_no' =>  $operation['no'],
                'operation_name' => $operation['name'],

            ];
        });
    }

    public function getFlagAttribute()
    {
        $flag = null;
        if ($this->is_green) {
            $flag = 'green';
        }
        if ($this->is_yellow) {
            $flag = 'yellow';
        }
        if ($this->is_red) {
            $flag = 'red';
        }
        return (!$flag) ? $this->flagPolicy($this->repair_pcs) : $flag;
    }
    public function flagPolicy($qty)
    {
        if ($qty == 1) {
            return 'yellow';
        } elseif ($qty >= 2) {
            return 'red';
        } else {
            return 'green';
        }
    }
    public function getTimeAttribute()
    {
        return $this->created_at;
    }
    public function getReportDateAttribute()
    {
        return ($this->created_at)? $this->created_at->format('Y-m-d : H-i'): '';
    }

    public function scopeToday($q)
    {
        return $q->whereDate('created_at', Carbon::today()->toDateString());
    }
    public function scopeGetOperator($q, $v)
    {
        return $q->where('operator_id', '=', $v);
    }
    public function scopeTodayIncomplete($q)
    {
        return $q->today()->where('inspected_pcs', '<', 5);
    }
    public function scopeProfileAndOPCode($q, $v)
    {
        return (Arr::accessible($v)) ? $q->select('id')->whereIn('id', $v) : $q->select('id')->where('id', '=', $v);
    }
    public function scopeGetMonth($q, $v)
    {
        $start = Carbon::parse($v)->startOfMonth()->format('Y-m-d 00:00:00');
        $end = Carbon::parse($v)->endOfMonth()->format('Y-m-d 23:59:59');

        return $q->whereBetween('created_at', [$start, $end]);
    }
    public function scopeGetProfile($q, $v)
    {
        return (Arr::accessible($v)) ? $q->whereIn('id', $v) : $q->where('id', '=', $v);
    }

    public function scopeCompletedRoutine($q)
    {
        return $q->where('inspected_pcs', '=', 5);
    }
    public function scopeInCompletedRoutine($q)
    {
        return $q->where('inspected_pcs', '<', 5);
    }
    public function scopeModule($q, $v)
    {
        return $q->where('module', '=', $v);
    }

}
