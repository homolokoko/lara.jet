<?php

namespace App\Models\Configure\Measure\Profile;

use Bkwld\Cloner\Cloneable;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Staudenmeir\EloquentHasManyDeep\HasRelationships;

class Color extends Model
{
    use HasFactory;
    use HasRelationships;
    use Cloneable;

    protected $fillable = ['header_id', 'color_id'];
    protected $table = 'measure_profile_color';
    public $timestamps = false;

    public function name()
    {
        return $this->belongsTo(\App\Models\Configure\Color::class, 'color_id');
    }
}
