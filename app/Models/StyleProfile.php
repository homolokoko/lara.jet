<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Staudenmeir\EloquentHasManyDeep\HasRelationships;

use App\Models\StyleProfile as Profile;

class StyleProfile extends Model
{
    use HasFactory;
    use HasRelationships;

    protected $table = 'style_profile';

    public function style()
    {
        return $this
            ->belongsTo(
                Style::class,
                'style_id'
            );
    }

    public function version()
    {
        return $this
            ->belongsTo(
                Version::class,
                'version_id',
            );
    }

    public function profileColors()
    {
        return $this
            ->hasMany(
                Profile\Color::class,
                'style_profile_id'
            );
    }

    public function profileSizes()
    {
        return $this
            ->hasMany(
                Profile\Size::class,
                'style_profile_id'
            );
    }

    public function profileApparels()
    {
        return $this
            ->hasMany(
                Profile\Apparel::class,
                'style_profile_id'
            );
    }

    public function colors()
    {
        return $this
            ->hasManyDeepFromRelations(
                $this->profileColors(),
                (new Profile\Color)->color()
            );
    }

    public function sizes()
    {
        return $this
            ->hasManyDeepFromRelations(
                $this->profileSizes(),
                (new Profile\Size)->size()
            );
    }

    public function apparels()
    {
        return $this
            ->hasManyDeepFromRelations(
                $this->profileApparels(),
                (new Profile\Apparel)->apparel()
            );
    }
}
