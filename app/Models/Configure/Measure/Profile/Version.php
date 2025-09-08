<?php

namespace App\Models\Configure\Measure\Profile;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Staudenmeir\EloquentHasManyDeep\HasRelationships;

class Version extends Model
{
    use HasFactory;
    use HasRelationships;
    protected $fillable = ['measure_profile_header_id', 'version_id'];
    protected $table = 'measure_profile_version';

    public function profile()
    {
        return $this->belongsTo(Header::class, 'measure_profile_header_id');
    }
    public function version()
    {
        return $this->belongsTo(Version::class, 'version_id');
    }
    public function style()
    {
        return $this->hasOneDeepFromRelations(
            $this->profile(),
            (new Header())->style()
        );
    }
}
