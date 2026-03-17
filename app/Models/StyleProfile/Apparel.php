<?php

namespace App\Models\StyleProfile;

use App\Models\StyleApparel;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Staudenmeir\EloquentHasManyDeep\HasRelationships;

class Apparel extends Model
{
    use HasFactory;
    use HasRelationships;

    protected $table = 'style_profile_apparel';
    protected $fillable = ['style_profile_id','style_apparel_id'];

    public function styleApparel()
    {
        return $this
            ->belongsTo(
                StyleApparel::class,
                'style_apparel_id'
            );
    }

    public function apparel()
    {
        return $this->hasOneDeepFromRelations(
            $this->styleApparel(),
            (new StyleApparel)->apparel()
        );
    }
}
