<?php

namespace App\Models\Inspector\HumidityTest;

use App\Models\Configure\Fabric\StyleFabricContent;
use App\Models\Configure\Humidity\TimePeriod;
use App\Models\Configure\Styles;
use App\Models\Configure\WorkstationLocate;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Staudenmeir\EloquentHasManyDeep\HasRelationships;

class Form extends Model
{
    use HasFactory;
    use SoftDeletes;
    use HasRelationships;

    public $table = 'insp_humidity';
    protected $fillable =  [
        'styles_id',  'time_period',   'inspector_id',    'locate',    'humidity',    'temperature'
    ];
    public function scopeToday($q)
    {
        return $q->whereDate('created_at', today());
    }
    public  function buyer(){
        return $this->hasOneDeepFromRelations($this->style(), (new Styles)->buyer());
    }
    public function style(): \Illuminate\Database\Eloquent\Relations\BelongsTo
    {
        return $this->belongsTo(Styles::class,'styles_id');
    }
    public function locate(): \Illuminate\Database\Eloquent\Relations\BelongsTo
    {
        return $this->belongsTo(WorkstationLocate::class, 'locate');
    }
    public function period(){
        return $this->belongsTo( TimePeriod::class, 'time_period');
    }
    public function scopeFilterStyleName($q, $style){
        return $q->whereHas('style', function ($query) use ($style) {
            return $query->where('style.id', $style);
        });

    }
}
