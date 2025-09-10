<?php

namespace App\Models\Inspector\Inline;

use App\Models\Configure\JobSeqs;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Jobseq extends Model
{
    use HasFactory;
    public $table = 'insp_inline_jobseq';
    protected $fillable = ['insp_inline_profile_id', 'jobseq_id'];
    public $timestamps = false;

    function operation()
    {
        return $this->belongsTo(JobSeqs::class, 'jobseq_id');
    }
}
