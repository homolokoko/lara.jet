<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Staudenmeir\EloquentHasManyDeep\HasRelationships;

class StyleApparel extends Model
{
    use HasFactory;
    use HasRelationships;

    protected $table = 'style_apparel';
    protected $fillable = ['style_id','name','image','apparel_id','editable'];

    public function apparel()
    {
        return $this
            ->belongsTo(
                Apparel::class,
                'apparel_id'
            );
    }

    public function apparelCheckpoint()
    {
        return $this
            ->hasMany(
                StyleApparel\Checkpoint::class,
                'style_apparel_id'
            );
    }

    public function checkpoints()
    {
        return $this
            ->hasManyDeepFromRelations(
                $this->apparelCheckpoint(),
                (new StyleApparel\Checkpoint)->checkpoints()
            );
    }
}
