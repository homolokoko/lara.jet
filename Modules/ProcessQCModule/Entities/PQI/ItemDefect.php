<?php

namespace Modules\ProcessQCModule\Entities\PQI;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class ItemDefect extends Model
{
    use HasFactory;

    public $timestamps = false;
    protected $table = 'pqi_item_defect';
    protected $fillable = ['pqi_item_id','pqi_defect_id','photo'];
    protected $appends = ['defect_desc','defect_serverities'];

    public function defect()
    {
        return $this
            ->belongsTo(
                Defect::class,
                'pqi_defect_id'
            );
    }

    public function getDefectDescAttribute()
    {
        return $this->defect->name;
    }

    public function getDefectServeritiesAttribute()
    {
        return $this->defect->serverity;
    }

    protected static function newFactory()
    {
        return \Modules\ProcessQCModule\Database\factories\PQI/ItemDefectFactory::new();
    }
}
