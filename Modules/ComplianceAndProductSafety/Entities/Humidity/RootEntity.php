<?php

namespace Modules\ComplianceAndProductSafety\Entities\Humidity;

use App\Models\Location;
use App\Models\Style;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class RootEntity extends Model
{
    use HasFactory;

    protected $table = 'humidity_root';
    protected $fillable = ['location_id','style_id','time_period_id','fabric_content_id','humidity','temperature'];

    public function style()
    {
        return $this
            ->belongsTo(
                Style::class,
                'style_id'
            );
    }

    public function location()
    {
        return $this
            ->belongsTo(
                Location::class,
                'location_id'
            );
    }

    public function timePeriod()
    {
        return $this
            ->belongsTo(
                TimePeriodEntity::class,
                'time_period_id'
            );
    }

    protected static function newFactory()
    {
        return \Modules\ComplianceAndProductSafety\Database\factories\Humidity/RootEntityFactory::new();
    }
}
