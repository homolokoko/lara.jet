<?php

namespace App\Models\Tuition;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Detail extends Model
{
    use HasFactory;

    public $timestamps = false;
    protected $table = 'tuition_detail';
    protected $fillable = ['tuition_info_id','desc','amount'];

    public function info()
    {
        return $this->belongsTo(Info::class, 'tuition_info_id');
    }
}
