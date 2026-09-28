<?php

namespace App\Models\Inspector\Cutting\CheckList;

use App\Models\Configure\Defect\Cause;
use App\Models\Configure\Defects;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Defectpoint extends Model
{
    use HasFactory;
    public $table="cutting_checklist_defect";
    protected $fillable = ['cutting_header_id','defect_id','is_correct','defects_cause_id'];
    public $timestamps = false; 
    
    public function defect(){
        return $this->belongsTo(Defects::class,'defect_id');
    }
    public function cause(){
        return $this->belongsTo(Cause::class,'defects_cause_id');
    }
}
