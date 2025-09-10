<?php

namespace App\Models\Configure;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class DefectsJobSeqs extends Model
{
    use HasFactory;
    protected $table='defect_jobseq';
    protected $fillable =['defects_id','job_seqs_id'];

    public function defects (){
        return $this->belongsTo(Defects::class,'defects_id');
    }
    public function jobseqs(){
        return $this->belongsTo(JobSeqs::class,'job_seqs_id');
    }
}
