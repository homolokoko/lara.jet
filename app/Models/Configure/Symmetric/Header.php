<?php

namespace App\Models\Configure\Symmetric;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Header extends Model
{
    use HasFactory;
    use SoftDeletes;

    protected $primaryKey = 'id';
    protected $table = 'symmetric_header';
    protected $fillable = ['style_id'];

    public function style()
    {
        return $this->belongsTo(\App\Models\Configure\Styles::class, 'style_id');
    }
    public function symmetricVersions()
    {
        return $this->hasMany(Version::class, 'symmetric_header_id', 'id');
    }
    public function symmetricGroupVersions()
    {
        return $this->hasMany(GroupVersion::class, 'symmetric_header_id', 'id');
    }

    // public function versions()
    // {
    //     return $this->hasManyDeepFromRelations(
    //         $this->symmetricVersions(),
    //         (new Version)->version()
    //     );
    // }

    public function versions()
    {
        return $this->hasManyThrough(
            \App\Models\Configure\Version::class,
            Version::class,
            'symmetric_header_id',
            'id',
            'id',
            'version_id',
        );
    }
    public function measureProfileDetail()
    {
        return $this->hasManyThrough(
            \App\Models\Configure\Measure\Profile\Detail::class,
            Detail::class,
            'symmetric_header_id',
            'id',
            'id',
            'measure_profile_detail_id',
        );
    }
}
