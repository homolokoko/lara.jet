<?php

namespace Modules\ProcessQCModule\Entities\PQI;

use App\Models\Color;
use App\Models\Location;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Item extends Model
{
    use HasFactory;

    protected $table = 'pqi_item';

    protected $fillable = ['pqi_header_id','color_id','inspector_id','desc','workstation_locate_id'];

    public function defects()
    {
        return $this
            ->hasMany(
                ItemDefect::class,
                'pqi_item_id'
            );
    }

    public function color()
    {
        return $this
            ->belongsTo(
                Color::class,
                'color_id'
            );
    }

    public  function workstationLocate()
    {
        return $this
            ->belongsTo(
                Location::class,
                'workstation_locate_id'
            );
    }

    protected static function newFactory()
    {
        return \Modules\ProcessQCModule\Database\factories\PQI/ItemFactory::new();
    }
}
