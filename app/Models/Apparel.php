<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Staudenmeir\EloquentHasManyDeep\HasRelationships;

class Apparel extends Model
{
    use HasFactory;
    use HasRelationships;

    protected $table = 'apparel';
    protected $fillable = ['name','description','image'];

    public function styleApparels()
    {
        return $this
            ->hasMany(
                StyleApparel::class,
                'apparel_id'
            );
    }

    public function checkpoints()
    {
        return $this
            ->hasManyDeepFromRelations(
                $this->styleApparels(),
                (new StyleApparel)->checkpoints()
            );
    }
}
