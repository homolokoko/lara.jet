<?php

namespace App\Models\Inspector;

use App\Models\Configure\Size;


use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class SymmetryMeasurement extends Model
{
    use HasFactory;
    use \Staudenmeir\EloquentHasManyDeep\HasRelationships;

    protected $table = 'symmetry_measurement';
    protected $primarykey = 'id';
    protected $fillable = [
        'size_id',
        'description',
        'tolerance_min',
        'tolerance_max',
        'expected_value',
        'measure_profile_detail_id'
    ];

    public function sizeList()
    {
        return $this->hasMany(Size::class, 'id', 'size_id');
    }
}
