<?php

namespace App\Models\Inspector\Cutting;

use App\Models\Configure\Defect\Cause;
use App\Models\Configure\Defects;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class RecapDefect extends Model
{
    use HasFactory;
    protected $table = 'cutting_recap_defects';
    protected $fillable = ['defects_id','cutting_recap_id','defects_cause_id'];
    public $timestamps = false; 

    public function name(){
        return $this->belongsTo(Defects::class,'defects_id');
    }
    public function cause(){
        return $this->belongsTo(Cause::class,'defects_cause_id');
    }
}
