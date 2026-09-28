<?php

namespace App\Models\Configure\Humidity;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class TimePeriod extends Model
{
    use HasFactory;
    use SoftDeletes;
    public $table = 'humidity_time_period';
    protected $fillable = [
        'name','from','to'
    ];


    function scopeCurrentPeriod($q){
        $currentTime = Carbon::now()->format('H:i:s');
        return $q->whereTime('from', '>=', $currentTime)->whereTime('to', '<=',$currentTime);
    }
}

