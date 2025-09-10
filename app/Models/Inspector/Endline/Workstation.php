<?php

namespace App\Models\Inspector\Endline;

use App\Models\Configure\WorkstationLocate;
use App\Models\Configure\Workstations;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Workstation extends Model
{
    use HasFactory;
    public $table = 'insp_endline_workstation';
    protected $fillable = ['insp_endline_profile_id','workstation_id'];
    public $timestamps = false;

    public function profile(){
        return $this->belongsTo(Profile::class,'insp_inline_profile_id');
    }
    public function locate(){
        return $this->hasOneThrough(
            WorkstationLocate::class,
            Workstations::class,'id','id','workstation_id','workstation_locate_id');
    }
    public function number(){
        return $this->belongsTo(Workstations::class,'workstation_id');
    }

}
