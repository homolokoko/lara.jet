<?php

namespace App\Models\Inspector\Endline;

use App\Http\Controllers\ShiftController;
use App\Models\Configure\Workstations;
use App\Models\Configure\WorkstationLocate;
use App\Models\Inspector\Inline\Operator;
use App\Models\User;
use App\Models\Configure\PurchaseOrders;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\Configure\Style\Profile as StyleProfile;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Support\Arr;
use Illuminate\Support\Carbon;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Support\Facades\DB;
use Staudenmeir\EloquentHasManyDeep\HasRelationships;

class Profile extends Model
{
    use HasFactory;
    use HasRelationships;
    use SoftDeletes;

    public $table = 'insp_endline_profile';
    protected $fillable = ['no', 'purchase_order_id', 'inspected_pcs',
        'repair_pcs', 'defect_rate', 'inspector_id', 'workstation_locates_id', 'style_profile_id'];
    protected $sequences = ['no'];
    protected $appends = ['weekOfYear', 'hours','reportDate'];

    public function locate()
    {
        return $this->belongsTo(WorkstationLocate::class, 'workstation_locates_id');
    }

    public function workstation()
    {
        return $this->hasMany(Workstation::class, 'insp_endline_profile_id');
    }

    public function EndlineWorkstation()
    {
        return $this->hasManyThrough(
            Workstations::class,
            Workstation::class,
            'insp_endline_profile_id',
            'id',
            'id',
            'workstation_id'
        );
    }
    public function inspector()
    {
        return $this->belongsTo(User::class, 'inspector_id');
    }
    public function item()
    {
        return $this->hasMany(Item::class, 'insp_endline_profile_id');
    }
    public function purchaseOrder()
    {
        return $this->belongsTo(PurchaseOrders::class, 'purchase_order_id');
    }
    public function styleProfile()
    {
        return $this->belongsTo(StyleProfile::class, 'style_profile_id');
    }
    public function style()
    {
        return $this->hasOneDeepFromRelations(
            $this->styleProfileTrashed(),
            (new StyleProfile())->stylesTrashed()
        );
    }
    public function version()
    {
        return $this->hasOneDeepFromRelations(
            $this->styleProfile(),
            (new StyleProfile())->version()
        );
    }
    public function styleProfileTrashed(): BelongsTo
    {
        return $this->belongsTo(StyleProfile::class, 'style_profile_id')->withTrashed();
    }
    public function latestItem()
    {
        return $this->hasOne(
            Item::class,
            'insp_endline_profile_id',
        )->latest('id')->select(
            'id',
            'item_no',
            'insp_endline_profile_id',
            'sizes_id',
            'color_id'
        );
    }
    public function latestColor()
    {
        return $this->hasOneDeepFromRelations(
            $this->latestItem(),
            (new Item())->color()
        )->select('color.id', 'color.name');
    }
    public function latestSize()
    {
        return $this->hasOneDeepFromRelations(
            $this->latestItem(),
            (new Item())->sizes()
        )->select('sizes.id', 'sizes.name');
    }
    public function latestApparel()
    {
        return $this->hasOneDeepFromRelations(
            $this->styleProfile(),
            (new StyleProfile())->apparelName()
        )->select('styles_apperals.id', 'styles_apperals.name');
    }

    public function latestProfile()
    {
        return $this->hasOneDeepFromRelations(
            $this->styleProfile(),
            (new StyleProfile())->version()
        )->select('version.id', 'version.name');
    }
    public function latestPurchaseOrder()
    {
        return $this->purchaseOrder()->select(['id','no']);
    }
    public function latestStyle()
    {
        return $this->style()->select(['styles.id','styles.name']);
    }
    public function latestWorkStation()
    {
        return $this->hasOneDeep(
            Workstations::class,
            [ Profile::class, Workstation::class],
            ['id','', 'insp_endline_profile_id', 'id'],
            ['id','', 'id', 'workstation_id'],
        )->select('workstations.id', 'workstations.name');
    }
    public function getApparelStyleProfile()
    {
        return $this->hasManyDeepFromRelations(
            $this->styleProfile(),
            (new StyleProfile())->apparel()
        );
    }


    public function getWeekOfYearAttribute()
    {
        return Carbon::parse($this->created_at)->weekOfYear;
    }
    public function getHoursAttribute()
    {
        return Carbon::parse($this->created_at)->hour;
    }
    public function getReportDateAttribute()
    {
        return Carbon::parse($this->created_at)->format('Y-m-d');
    }
    public function itemRepair()
    {
        return $this->hasManyDeepFromRelations(
            $this->item(),
            (new Item())->repair()
        );
    }
    public function itemDefect()
    {
        return $this->hasManyDeepFromRelations(
            $this->item(),
            (new Item())->defect()
        );
    }
    public function scopeLocateStation($q, $v)
    {
        if (Arr::accessible($v)) {
            return $q->whereIn('workstation_locates_id', $v);
        }
        return $q->where('workstation_locates_id', '=', $v);
    }
    public function scopeNightShift($q, $v)
    {
        $shift = new ShiftController();
        $shift->date = $v;
        $shift->getNight();
    }

    public function scopeSpecificPeriod($q, $v = null)
    {
        list($from, $to) = $v;
        if ($from && $to) {
            $startTime = Carbon::createFromFormat('Y-m-d H:i:s', $from);
            $endTime = Carbon::createFromFormat('Y-m-d H:i:s', $to);
            return $q->whereBetween('created_at', [$startTime, $endTime]);
        } else {
            dd('error', $v);
        }
    }


    public function scopeDate($q, $v)
    {
        $isArray = ($v) ? Arr::accessible($v) : false;
        $date = (!$v && !$isArray) ? today() : $v;


        if (!$isArray) {
            return $q->where('report_date', '=', $date);
        }

        if (count($v) > 1) {
            list($from, $to) = $v;
            //dd($from, $to,Carbon::parse($from)->timezone('Asia/Phnom_Penh'), Carbon::parse($to)->addDays(1)->timezone('Asia/Phnom_Penh'));
            return $q->whereBetween('created_at', [Carbon::parse($from)->timezone('Asia/Phnom_Penh'), Carbon::parse($to)->addDays(1)->timezone('Asia/Phnom_Penh')]);
        } else {
            $getDate = Arr::get($v, '0');
            //$from = Carbon::parse($getDate)->timezone('Asia/Phnom_Penh')->startOfDay()->format('Y-m-d H:i:s');
            //$to = Carbon::parse($getDate)->timezone('Asia/Phnom_Penh')->endOfDay()->format('Y-m-d H:i:s');
            //debug($v, $getDate, $from, $to);
            return $q->where('created_at', '=', Carbon::parse($getDate)->timezone('Asia/Phnom_Penh'));
        }
    }
    public function scopeTodaysByHour($query, $locateId, $inspector, $hour = null)
    {
        return $query->select(['id', 'no', 'created_at'])
            ->whereDate('created_at', today())
            ->where([
                'workstation_locates_id' => $locateId,
                'inspector_id' => $inspector,
            ])
            ->whereRaw('HOUR(created_at) = ?', [$hour ?? now()->hour]);
    }

    public function itemsPassed()
    {
        return $this->item();
    }

    public function itemsDefect()
    {
        return $this->item();
    }

    public function itemsFirstTimeWrong()
    {
        return $this->item()->wrongFirstTime();
    }

    public function firstTimeChecked()
    {
        return $this->item()->firstTimeCheck();
    }
    public function rightFirstTimeItems()
    {
        return $this->item()->rightFirsTime();
    }
    public function wrongFirstTimeItems()
    {
        return $this->item()->wrongFirstTime();
    }





}
