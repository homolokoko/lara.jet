<?php

namespace App\Models\Inspector\Cutting\Measure;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Staudenmeir\EloquentHasManyDeep\HasRelationships;

class Size extends Model
{
    use HasFactory;
    use HasRelationships;
    protected $table = "cutting_panel_measure_size";
    protected $fillable = ['size_id'];
    public $timestamps = false;
    function sizeRecord(): \Illuminate\Database\Eloquent\Relations\HasMany
    {
        return $this->hasMany(Record::class,'panel_measure_size_id');
    }
    function name()
    {
        return $this->belongsTo(\App\Models\Configure\Size::class, 'size_id');
    }
}
