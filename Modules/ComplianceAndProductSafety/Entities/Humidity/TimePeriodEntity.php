<?php

namespace Modules\ComplianceAndProductSafety\Entities\Humidity;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class TimePeriodEntity extends Model
{
    use HasFactory;

    protected $table = 'humidity_time_period';

    protected $fillable = ['name', 'from', 'to'];

    protected static function newFactory()
    {
        return \Modules\ComplianceAndProductSafety\Database\factories\Humidity\TimePeriodEntityFactory::new();
    }
}
