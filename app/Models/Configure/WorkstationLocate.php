<?php

namespace App\Models\Configure;

use App\Models\Inspector\Inline\Workstation;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Support\Arr;
use Staudenmeir\EloquentHasManyDeep\HasRelationships;
use Vicklr\MaterializedModel\MaterializedModel;

class WorkstationLocate extends MaterializedModel
{
    use HasFactory;
    use SoftDeletes;
    use HasRelationships;

    public $table = 'workstation_locates';
    protected string $orderColumn = 'sort';

    protected $fillable = [
        'name', 'workstation_locates_type_id', 'is_day_shift', 'sort',
        'parent_id'
    ];
    protected $hidden = [
        'created_at',
        'updated_at',
    ];
    protected $appends = ['children','isRoot'];


    public function Type()
    {
        return $this->belongsTo(WorkstationLocateType::class, 'workstation_locates_type_id');
    }
    public function workstation()
    {
        return $this->hasMany(Workstations::class, 'workstation_locate_id');
    }
    public function scopeLocateType($q, $locate)
    {
        return $q->where(['id' => $locate]);
    }

    public function scopeSewLine($q)
    {
        return $q->orWhere(['workstation_locates_type_id' => 1]);
    }
    public function scopeSection($q)
    {
        return $q->orWhere(['workstation_locates_type_id' => 9]);
    }
    public function scopeRecovery($q)
    {
        return $q->orWhere(['workstation_locates_type_id' => 6]);
    }


    public function scopeDayShift($q, bool $v)
    {
        return $q->where(['is_day_shift' => $v]);
    }
    public function scopePacking($q)
    {
        return $q->orWhere(['workstation_locates_type_id' => 2]);
    }
    public function scopeOffline($q)
    {
        return $q->orWhere(['workstation_locates_type_id' => 8]);
    }
    public function scopeEmbellishment($q)
    {
        return $q->orWhere(['workstation_locates_type_id' => 10]);
    }
    public function scopeFinishing($q)
    {
        return $q->orWhere(['workstation_locates_type_id' => 11]);
    }



    public function scopeAfterWash($q,$shift = null)
    {
        if($shift){
            return $q->where(['workstation_locates_type_id' => 7, 'is_day_shift' => $shift]);
        }
        return $q->where(['workstation_locates_type_id' => 7]);
    }
    /*public function getNameAttribute($value)
    {
        if($this->workstation_locates_type_id == 7) {
            $shift =  ($this->is_day_shift) ? ' (Day )' : ' (Night )';
            return 'After Wash '.$shift ;
        } else {

            return $value;
        }
    }*/

    public function inlineWorkStation()
    {
        return $this->hasManyThrough(
            Workstation::class,
            Workstations::class,
            'workstation_locate_id',
            'id',
            'id',
            'id'
        );
    }
    public function inlineProfile()
    {
        return $this->hasManyDeepFromRelations(
            $this->workstation(),
            (new Workstations())->inlineProfile()
        );
    }
    public function getChildrenAttribute()
    {
        return $this->children()->get();
    }
    public function getIsRootAttribute()
    {
        return $this->isRoot();
    }
    public function scopeSewLineShiftType($q, $shift)
    {
        return $q->where(['is_day_shift' => $shift, 'workstation_locates_type_id' => 1]);
    }
    public function scopeEziLocate($q, $locate)
    {
        return $q->whereRaw(" CAST(REGEXP_SUBSTR(name, '[0-9]{1,2}')  AS UNSIGNED) = ".$locate);
    }
    public function scopeSewLineZero($q,$shift){
        $line = 'line 0 ';
        $line .= (!$shift)? '(night)' : '(day)';
        return $q->where(['name' => $line, 'is_day_shift' => $shift]);
    }
}
