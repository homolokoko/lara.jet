<?php

namespace App\Models\Configure;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Arr;
use Staudenmeir\EloquentHasManyDeep\HasRelationships;

class Workstations extends Model
{
    use HasFactory;
    use HasRelationships;
    protected $fillable = ['name', 'workstation_category_id', 'workstation_locate_id'];

    function workstationCategory()
    {

        return $this->belongsTo(WorkstationCategory::class, 'workstation_category_id');
    }
    function workstationLocate()
    {
        return $this->belongsTo(WorkstationLocate::class, 'workstation_locate_id');
    }
    function workstationJobSeqs()
    {
        return $this->hasMany(JobSeqs::class);
    }
    function locate()
    {
        return $this->belongsTo(WorkstationLocate::class, 'workstation_locate_id');
    }
    function inline(){
        return $this->hasMany(\App\Models\Inspector\Inline\Workstation::class, 'workstation_id');
    }
    function inlineProfile(){
        return $this->hasManyDeepFromRelations($this->inline(), (new \App\Models\Inspector\Inline\Workstation)->profile());
    }
    function inlineProblem(): \Staudenmeir\EloquentHasManyDeep\HasManyDeep
    {
        return $this->hasManyDeepFromRelations($this->inlineProfile(), (new \App\Models\Inspector\Inline\Profile)->problem());
    }
    function inlineOperator(): \Staudenmeir\EloquentHasManyDeep\HasManyDeep
    {
        return $this->hasManyDeepFromRelations($this->inlineProfile(), (new \App\Models\Inspector\Inline\Profile)->operator());

    }


    function scopeInlinePack($q)
    {
        return $q->where(['workstation_locate_id' => 22]);
    }
    function scopeOffline($q)
    {
        return $q->where(['workstation_locate_id' => 52]);
    }
    function scopeSewLine($q, $v)
    {
        return (Arr::accessible($v)) ? $q->whereIn('workstation_locate_id', $v) : $q->where('workstation_locate_id', '=', $v);
    }



}
