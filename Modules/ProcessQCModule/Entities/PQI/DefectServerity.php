<?php

namespace Modules\ProcessQCModule\Entities\PQI;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class DefectServerity extends Model
{
    use HasFactory;

    public $timestamps = false;
    protected $table = 'pqi_defect_serverity';
    protected $fillable = ['type','value','pqi_defect_id'];
    protected $appends = ['desc'];

    function getDescAttribute()
    {
        switch($this->type){
            case 1:
                return 'critical';
                break;
            case 2:
                return 'major';
                break;
            case 3:
                return 'minor';
                break;
        }
    }

    protected static function newFactory()
    {
        return \Modules\ProcessQCModule\Database\factories\PQI/DefectServerityFactory::new();
    }
}
