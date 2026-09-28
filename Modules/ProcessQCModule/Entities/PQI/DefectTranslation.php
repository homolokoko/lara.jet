<?php

namespace Modules\ProcessQCModule\Entities\PQI;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class DefectTranslation extends Model
{
    use HasFactory;

    public $timestamps = false;
    protected $table = 'pqi_defect_translations';
    protected $fillable = ['pqi_defect_id','locale', 'translated'];

    protected static function newFactory()
    {
        return \Modules\ProcessQCModule\Database\factories\PQI/DefectTranslationsFactory::new();
    }
}
