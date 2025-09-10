<?php

namespace App\Models\Inspector\Cutting;

use App\Models\User;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;
use Illuminate\Database\Eloquent\Relations ;
use Staudenmeir\EloquentHasManyDeep;
class Recap extends Model
{
    use HasFactory;
    use SoftDeletes;
    use EloquentHasManyDeep\HasRelationships;

    protected $table = 'cutting_recap';
    protected $fillable = [
        'cutting_header_id',
        'is_checklist', 'is_binAudit', 'is_cutPanel',
        'is_defect', 'is_checkpoint', 'image', 'inspector_id', 'is_resolve',
    ];
    protected $appends = ['displayPointName', 'pointName', 'section'];
    protected $casts = [
        'is_resolve' => 'boolean',
    ];
    function getImageAttribute($v): string
    {
        $existTmp = Storage::disk('tmp')->exists($v);
        $file = '';
        if ($v && $existTmp) {
            $file = Storage::disk('tmp')->url($v);
        } else if ($v && !$existTmp) {
            $file = Storage::disk('cutting')->url($v);
        }
        return $file;
    }

    function scopeCheckList($q)
    {
        return $q->where(['is_checklist' => 1]);
    }
    function scopeBinAuditList($q)
    {
        return $q->where(['is_binAudit' => 1]);
    }
    function scopeCutPanelList($q)
    {
       return  $q->where(['is_cutPanel' => 1]);
    }
    function scopeCheckPoint($q){
        return $q->where(['is_checkpoint' => 1]);
    }
    function scopeHeader($q, $v){
       return  $q->where(['cutting_header_id' => $v]);
    }

    function getSectionAttribute()
    {
        if ($this->is_checklist) {
            return Str::of('Spreading')->headline()->__toString();
        }
        if ($this->is_cutPanel) {
            return Str::of('Panel')->headline()->__toString();
        }
        if ($this->is_binAudit) {
            return Str::of('Bin Audit')->headline()->__toString();
        }
    }


    function  getPointNameAttribute()
    {
        if ($this->is_checklist === 1 && $this->is_defect == 1) {
            return $this->defectsName()->first()->name .' cause by '. $this->causeName()->first()->name ;
        } else if ($this->is_checklist === 1 && $this->is_checkpoint == 1) {
            return $this->checkPointName()->first()->name;
        } else if ($this->is_binAudit == 1 && $this->is_checkpoint == 1) {
            return $this->cabinAuditCheckPoint()->first()->name;
        } else if ($this->is_cutPanel == 1) {
            if ($this->cutPanelRecapSize()->first()) {
                $size = $this->cutPanelRecapSize()->first()->name;
                $panel = $this->cutPanelRecapPanel()->first()->name;
                $position = $this->cutPanel()->first()->stack_position;
                return $panel . " - " . $position . " - " . $size;
            }
        }
        return '-';
    }
    function getDisplayPointNameAttribute()
    {
        if ($this->is_checklist === 1 && $this->is_defect == 1) {
            return '1. Spreading' . ' - ' . $this->defectsName()->first()->name  .' cause by '. $this->causeName()->first()->name ;
        } else if ($this->is_checklist === 1 && $this->is_checkpoint == 1) {
            return '1. Spreading' . ' - ' . $this->checkPointName()->first()->name;
        } else if ($this->is_binAudit == 1 && $this->is_checkpoint == 1) {
            return '3. Bin Audit' . ' - ' . $this->cabinAuditCheckPoint()->first()->name;
        } else if ($this->is_cutPanel == 1) {
            if ($this->cutPanelRecapSize()->first()) {
                $size = $this->cutPanelRecapSize()->first()->name;
                $panel = $this->cutPanelRecapPanel()->first()->name;
                $position = $this->cutPanel()->first()->stack_position;
                return "2. " . $panel . " - " . $position . " - " . $size;
            }

            return '';
        }
        return '-';
    }

    function checkPoint(): Relations\HasMany
    {
        return $this->hasMany(RecapCheckPoint::class, 'cutting_recap_id');
    }
    function checkPointName()
    {
        return $this->hasManyDeepFromRelations(
            $this->checkPoint(),
            (new RecapCheckPoint)->name()
        );
    }
    function defects(): Relations\HasMany
    {
        return $this->hasMany(RecapDefect::class, 'cutting_recap_id');
    }
    function defectsName(): EloquentHasManyDeep\HasManyDeep
    {
        return $this->hasManyDeepFromRelations(
            $this->defects(),
            (new RecapDefect)->name()
        );
    }
    function causeName(): EloquentHasManyDeep\HasManyDeep
    {
        return $this->hasManyDeepFromRelations(
            $this->defects(),
            (new RecapDefect)->cause()
        );
    }
    function cabinAudit(): Relations\HasOne
    {
        return $this->hasOne(RecapCabinAudit::class, 'cutting_recap_id');
    }
    function cabinAuditCheckPoint(): EloquentHasManyDeep\HasManyDeep
    {
        return $this->hasManyDeepFromRelations(
            $this->cabinAudit(),
            (new RecapCabinAudit)->checkPoint()
        );
    }

    function log(): Relations\HasMany
    {
        return $this->hasMany(RecapLog::class, 'cutting_recap_id');
    }
    function inspector(): Relations\BelongsTo
    {
        return $this->belongsTo(User::class, 'inspector_id');
    }
    function cutPanel(): Relations\HasMany
    {
        return $this->hasMany(RecapCutPanel::class, 'cutting_recap_id');
    }
    function cutPanelRecapSize(): EloquentHasManyDeep\HasManyDeep
    {
        return $this->hasManyDeepFromRelations(
            $this->cutPanel(),
            (new RecapCutPanel)->size()
        );
    }
    function cutPanelRecapPanel(): EloquentHasManyDeep\HasManyDeep
    {
        return $this->hasManyDeepFromRelations(
            $this->cutPanel(),
            (new RecapCutPanel)->panel()
        );
    }
}




