<?php

namespace App\Models\Configure;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class WorkstationJobSeqs extends Model
{
    use HasFactory;
    protected $table='workstation_jobseq';
    protected $fillable =['workstation_id','job_seqs_id'];

    public function workstations (){
        return $this->belongsTo(Workstations::class,'defects_id');
    }
    public function jobseqs(){
        return $this->belongsTo(JobSeqs::class,'job_seqs_id');
    }
}
