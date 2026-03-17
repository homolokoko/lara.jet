<?php

namespace App\Models\Configure\Module;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\Configure\WorkstationLocate;
use App\Models\Configure\Module;


class Locates extends Model
{
    use HasFactory;
    protected $table = 'module_locates';
    protected $fillable = [
        'module_id','workstation_location_id'
    ];


    function name(){
        return $this->belongsTo(WorkstationLocate::class,'workstation_location_id',);
    }
    function module(){
        return $this->belongsTo(Module::class,'module_id',);
    }
    function scopeModule($q,$v){
        return $q->whereHas('module',function($q) use ($v){
            return $q->where('name',$v);
        });
    }

}
