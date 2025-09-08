<?php

namespace App\Models\Configure;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\Configure\WorkstationLocate;
use Illuminate\Support\Str;
class DefectsWorkstationLocate extends Model
{
    use HasFactory;
    public $table = "defect_workstation_locates";
    protected $fillable =['defects_id','defect_workstation_locates_id'];

    public function defects(){
        return $this->belongsTo(Defects::class,'defects_id');
    }
    public function workstationlocate(){
        return $this->belongsTo(WorkstationLocate::class,'defect_workstation_locates_id');
    }
    public function scopeDefectsList($q,$locate){
        $defectList = $q->with('defects.translations')->where('defect_workstation_locates_id','=',$locate)->get();
        $defectList = $defectList->pluck('defects')->transform(function($item){
            return [
                'value'=> $item->id,
                'text'=> Str::of($item->name)->lower()->title()->trim()
            ];
        });
        return (object) $defectList;
    }
    public function scopeInlinePack($q){
        return $q->where(['defect_workstation_locates_id'=>'22']);
    }
}
