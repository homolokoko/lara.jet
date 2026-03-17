<?php

namespace App\Models\Configure;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class DefectsSource extends Model
{
    use HasFactory;
    public $table = 'defect_source';
    protected $fillable =['defects_id','defect_source_id'];

    public function source(){
        return $this->belongsTo(DefectsSourceTitle::class,'defect_source_id');
    }
}
